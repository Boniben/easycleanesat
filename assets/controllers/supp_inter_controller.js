import { Controller } from '@hotwired/stimulus';

/**
 * Contrôleur Stimulus pour la section supports/actions du formulaire intervention.
 *
 * Responsabilités :
 * - Chargement AJAX des supports selon la zone sélectionnée
 * - Toggle sélection des supports (style tile-card)
 * - Drag-and-drop natif HTML5 pour réordonner les supports sélectionnés
 * - Barre de recherche pour ajouter des actions
 * - Checkboxes pour associer chaque action aux supports sélectionnés
 * - Sérialisation JSON dans un champ hidden pour soumission au serveur
 */
export default class extends Controller {
    static targets = [
        'zone',
        'supportsSection',
        'supportsGrid',
        'actionsSection',
        'actionSearch',
        'actionDropdown',
        'actionsList',
        'hiddenData',
    ];

    static values = {
        supportsUrl: String,
        actions: Array,
        initialData: String,
        initialZoneId: String,
    };

    // État interne
    allSupports = [];        // [{id, nom, type_support_id}] depuis l'API
    selectedSupports = [];   // [{supportClientId, orderPosition, nom}]
    addedActions = [];       // [{actionsId, label, suppInterPositions: [1,2,...]}]
    dragSrcId = null;
    isDragging = false;

    connect() {
        // Pré-charger les données en mode édition
        const initial = this.initialDataValue;
        if (initial && initial !== 'null' && initial !== '') {
            try {
                const parsed = JSON.parse(initial);
                this.selectedSupports = (parsed.supports || []).map(s => ({
                    supportClientId: s.support_client_id,
                    orderPosition: s.order_position,
                    nom: s.nom || '',
                }));
                this.addedActions = (parsed.actions || []).map(a => ({
                    actionsId: a.actionsId,
                    label: a.label || ('Action #' + a.actionsId),
                    suppInterPositions: [...(a.suppInterPositions || [])],
                }));
            } catch (e) {
                console.error('supp_inter: erreur parsing initialData', e);
            }
        }

        // Charger les supports si une zone est déjà sélectionnée
        const zoneId = this.hasZoneTarget ? this.zoneTarget.value : this.initialZoneIdValue;
        if (zoneId) {
            this.loadSupports(zoneId);
        }
    }

    onZoneChange(event) {
        const zoneId = event.target.value;
        // Réinitialiser l'état
        this.selectedSupports = [];
        this.addedActions = [];
        this.allSupports = [];
        this.serialize();

        if (zoneId) {
            this.loadSupports(zoneId);
        } else {
            this.hideSections();
        }
    }

    async loadSupports(zoneId) {
        try {
            const url = this.supportsUrlValue.replace('__ZONE_ID__', zoneId);
            const response = await fetch(url);
            this.allSupports = await response.json();

            // En mode édition, les noms peuvent manquer dans selectedSupports → les remplir
            this.selectedSupports.forEach(sel => {
                if (!sel.nom) {
                    const found = this.allSupports.find(s => s.id === sel.supportClientId);
                    if (found) sel.nom = found.nom;
                }
            });

            this.renderSupportsGrid();
            this.showSupportsSection();

            if (this.selectedSupports.length > 0) {
                this.renderActionsList();
                this.showActionsSection();
            }
        } catch (e) {
            console.error('supp_inter: erreur chargement supports', e);
        }
    }

    // ─── Rendu de la grille de supports ────────────────────────────────────────

    renderSupportsGrid() {
        const grid = this.supportsGridTarget;
        grid.innerHTML = '';

        // Supports sélectionnés en premier (triés par position)
        const sortedSelected = [...this.selectedSupports].sort((a, b) => a.orderPosition - b.orderPosition);
        for (const sel of sortedSelected) {
            const support = this.allSupports.find(s => s.id === sel.supportClientId);
            if (support) {
                grid.appendChild(this.createSupportCard(support, true, sel.orderPosition));
            }
        }

        // Supports non sélectionnés
        for (const support of this.allSupports) {
            if (!this.selectedSupports.some(s => s.supportClientId === support.id)) {
                grid.appendChild(this.createSupportCard(support, false, null));
            }
        }

        this.serialize();
    }

    createSupportCard(support, selected, position) {
        const card = document.createElement('div');
        card.className = 'tile-item supp-card' + (selected ? ' selected' : '');
        card.dataset.supportId = support.id;

        const nameSpan = document.createElement('span');
        nameSpan.textContent = support.nom;
        card.appendChild(nameSpan);

        if (selected && position !== null) {
            const badge = document.createElement('span');
            badge.className = 'supp-position-badge';
            badge.textContent = 'Pos. ' + position;
            card.appendChild(badge);

            card.setAttribute('draggable', 'true');
            card.addEventListener('dragstart', this._onDragStart.bind(this));
            card.addEventListener('dragover', this._onDragOver.bind(this));
            card.addEventListener('dragleave', this._onDragLeave.bind(this));
            card.addEventListener('drop', this._onDrop.bind(this));
            card.addEventListener('dragend', this._onDragEnd.bind(this));
        }

        card.addEventListener('click', () => {
            if (this.isDragging) return;
            this.toggleSupport(support.id, support.nom);
        });

        return card;
    }

    toggleSupport(supportId, nom) {
        const idx = this.selectedSupports.findIndex(s => s.supportClientId === supportId);

        if (idx >= 0) {
            // Désélectionner
            const removedPos = this.selectedSupports[idx].orderPosition;
            this.selectedSupports.splice(idx, 1);

            // Renommer les positions restantes
            this.selectedSupports.sort((a, b) => a.orderPosition - b.orderPosition);
            this.selectedSupports.forEach((s, i) => { s.orderPosition = i + 1; });

            // Mettre à jour les positions dans les actions
            this.addedActions.forEach(a => {
                a.suppInterPositions = a.suppInterPositions
                    .filter(p => p !== removedPos)
                    .map(p => p > removedPos ? p - 1 : p);
            });
            // Supprimer les actions qui n'ont plus aucun support
            this.addedActions = this.addedActions.filter(a => a.suppInterPositions.length > 0);
        } else {
            // Sélectionner à la fin
            const newPos = this.selectedSupports.length + 1;
            this.selectedSupports.push({ supportClientId: supportId, orderPosition: newPos, nom });
        }

        this.renderSupportsGrid();
        this.renderActionsList();

        if (this.selectedSupports.length > 0) {
            this.showActionsSection();
        } else {
            this.hideActionsSection();
        }
    }

    // ─── Drag-and-drop ─────────────────────────────────────────────────────────

    _onDragStart(event) {
        this.isDragging = true;
        this.dragSrcId = parseInt(event.currentTarget.dataset.supportId);
        event.dataTransfer.effectAllowed = 'move';
    }

    _onDragOver(event) {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        event.currentTarget.classList.add('drag-over');
    }

    _onDragLeave(event) {
        event.currentTarget.classList.remove('drag-over');
    }

    _onDrop(event) {
        event.stopPropagation();
        const targetEl = event.currentTarget;
        targetEl.classList.remove('drag-over');

        const tgtId = parseInt(targetEl.dataset.supportId);
        if (this.dragSrcId === tgtId) return;

        const srcIdx = this.selectedSupports.findIndex(s => s.supportClientId === this.dragSrcId);
        const tgtIdx = this.selectedSupports.findIndex(s => s.supportClientId === tgtId);
        if (srcIdx < 0 || tgtIdx < 0) return;

        // Positions avant échange
        const srcOldPos = this.selectedSupports[srcIdx].orderPosition;
        const tgtOldPos = this.selectedSupports[tgtIdx].orderPosition;

        // Échanger les supports dans le tableau
        [this.selectedSupports[srcIdx], this.selectedSupports[tgtIdx]] =
            [this.selectedSupports[tgtIdx], this.selectedSupports[srcIdx]];

        // Recalculer les positions (ordre dans le tableau = ordre d'affichage)
        this.selectedSupports.sort((a, b) => {
            // Garder l'ordre après échange : la position de src est maintenant là où était tgt
            return 0; // l'échange est déjà fait dans le tableau
        });
        this.selectedSupports.forEach((s, i) => { s.orderPosition = i + 1; });

        const srcNewPos = this.selectedSupports[tgtIdx].orderPosition;
        const tgtNewPos = this.selectedSupports[srcIdx].orderPosition;

        // Mettre à jour les positions dans les actions
        this.addedActions.forEach(a => {
            a.suppInterPositions = a.suppInterPositions.map(p => {
                if (p === srcOldPos) return srcNewPos;
                if (p === tgtOldPos) return tgtNewPos;
                return p;
            });
        });

        this.renderSupportsGrid();
        this.renderActionsList();
    }

    _onDragEnd(event) {
        event.currentTarget.classList.remove('drag-over');
        // Délai pour éviter que le clic post-drag ne déclenche toggleSupport
        setTimeout(() => { this.isDragging = false; }, 50);
        this.dragSrcId = null;
    }

    // ─── Barre de recherche d'actions ──────────────────────────────────────────

    onActionSearchInput(event) {
        const query = event.target.value.toLowerCase().trim();
        if (!query) {
            this.hideDropdown();
            return;
        }

        const filtered = this.actionsValue.filter(a =>
            a.label.toLowerCase().includes(query) &&
            !this.addedActions.some(added => added.actionsId === a.id)
        );

        this.showDropdown(filtered);
    }

    onActionSearchBlur() {
        // Délai pour permettre le clic sur un item du dropdown
        setTimeout(() => this.hideDropdown(), 200);
    }

    showDropdown(actions) {
        const dropdown = this.actionDropdownTarget;
        dropdown.innerHTML = '';

        if (actions.length === 0) {
            const empty = document.createElement('div');
            empty.className = 'action-dropdown-empty';
            empty.textContent = 'Aucune action trouvée';
            dropdown.appendChild(empty);
        } else {
            actions.slice(0, 12).forEach(action => {
                const item = document.createElement('div');
                item.className = 'action-dropdown-item';
                item.textContent = action.label;
                item.addEventListener('mousedown', (e) => {
                    e.preventDefault(); // éviter le blur avant le clic
                    this.addAction(action);
                    this.actionSearchTarget.value = '';
                    this.hideDropdown();
                });
                dropdown.appendChild(item);
            });
        }

        dropdown.style.display = 'block';
    }

    hideDropdown() {
        if (this.hasActionDropdownTarget) {
            this.actionDropdownTarget.style.display = 'none';
        }
    }

    addAction(action) {
        if (this.addedActions.some(a => a.actionsId === action.id)) return;
        this.addedActions.push({
            actionsId: action.id,
            label: action.label,
            suppInterPositions: [],
        });
        this.renderActionsList();
        this.serialize();
    }

    removeAction(actionsId) {
        this.addedActions = this.addedActions.filter(a => a.actionsId !== actionsId);
        this.renderActionsList();
        this.serialize();
    }

    toggleActionSupport(actionsId, position) {
        const action = this.addedActions.find(a => a.actionsId === actionsId);
        if (!action) return;
        const idx = action.suppInterPositions.indexOf(position);
        if (idx >= 0) {
            action.suppInterPositions.splice(idx, 1);
        } else {
            action.suppInterPositions.push(position);
        }
        this.serialize();
    }

    // ─── Rendu de la liste des actions ─────────────────────────────────────────

    renderActionsList() {
        if (!this.hasActionsListTarget) return;
        const list = this.actionsListTarget;
        list.innerHTML = '';

        if (this.addedActions.length === 0) {
            return;
        }

        const sortedSelected = [...this.selectedSupports].sort((a, b) => a.orderPosition - b.orderPosition);

        this.addedActions.forEach(action => {
            const row = document.createElement('div');
            row.className = 'action-row';

            // En-tête de l'action
            const header = document.createElement('div');
            header.className = 'action-row-header';

            const title = document.createElement('strong');
            title.textContent = action.label;
            header.appendChild(title);

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'action-remove-btn';
            removeBtn.title = 'Retirer cette action';
            removeBtn.textContent = '✕';
            removeBtn.addEventListener('click', () => this.removeAction(action.actionsId));
            header.appendChild(removeBtn);
            row.appendChild(header);

            // Checkboxes par support sélectionné
            const checksDiv = document.createElement('div');
            checksDiv.className = 'action-support-checks';

            const assocLabel = document.createElement('span');
            assocLabel.className = 'action-associate-label';
            assocLabel.textContent = 'Associer à :';
            checksDiv.appendChild(assocLabel);

            sortedSelected.forEach(sel => {
                const label = document.createElement('label');
                label.className = 'action-support-check';

                const cb = document.createElement('input');
                cb.type = 'checkbox';
                cb.checked = action.suppInterPositions.includes(sel.orderPosition);
                cb.addEventListener('change', () => {
                    this.toggleActionSupport(action.actionsId, sel.orderPosition);
                });

                label.appendChild(cb);
                label.appendChild(document.createTextNode(' ' + sel.nom + ' (pos.' + sel.orderPosition + ')'));
                checksDiv.appendChild(label);
            });

            row.appendChild(checksDiv);
            list.appendChild(row);
        });
    }

    // ─── Sérialisation ─────────────────────────────────────────────────────────

    serialize() {
        if (!this.hasHiddenDataTarget) return;

        const data = {
            supports: this.selectedSupports
                .sort((a, b) => a.orderPosition - b.orderPosition)
                .map(s => ({
                    support_client_id: s.supportClientId,
                    order_position: s.orderPosition,
                })),
            actions: this.addedActions.map(a => ({
                actions_id: a.actionsId,
                supp_inter_positions: [...a.suppInterPositions],
            })),
        };

        this.hiddenDataTarget.value = JSON.stringify(data);
    }

    // ─── Visibilité des sections ────────────────────────────────────────────────

    showSupportsSection() {
        if (this.hasSupportsSectionTarget) {
            this.supportsSectionTarget.style.display = '';
        }
    }

    showActionsSection() {
        if (this.hasActionsSectionTarget) {
            this.actionsSectionTarget.style.display = '';
        }
    }

    hideActionsSection() {
        if (this.hasActionsSectionTarget) {
            this.actionsSectionTarget.style.display = 'none';
        }
    }

    hideSections() {
        if (this.hasSupportsSectionTarget) {
            this.supportsSectionTarget.style.display = 'none';
            if (this.hasSupportsGridTarget) this.supportsGridTarget.innerHTML = '';
        }
        this.hideActionsSection();
        if (this.hasActionsListTarget) this.actionsListTarget.innerHTML = '';
    }
}
