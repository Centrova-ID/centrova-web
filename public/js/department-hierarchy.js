/**
 * Interactive Organizational Chart
 * Features: Zoom, Pan, Search, Expand/Collapse, Employee Details
 */

class OrganizationalChart {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        this.svg = document.getElementById('org-chart-svg');
        this.nodesGroup = document.getElementById('nodes');
        this.connectionsGroup = document.getElementById('connections');
        
        // Chart state
        this.zoomLevel = 1;
        this.panX = 0;
        this.panY = 0;
        this.isDragging = false;
        this.dragStart = { x: 0, y: 0 };
        this.expandedNodes = new Set();
        this.searchResults = [];
        
        // Node dimensions
        this.nodeWidth = 200;
        this.nodeHeight = 80;
        this.levelHeight = 150;
        this.siblingMargin = 50;
        
        // Organization data
        this.orgData = {};
        this.hierarchy = {};
        
        this.init();
    }

    init() {
        this.loadOrgData();
        this.setupEventListeners();
        this.buildHierarchy();
        this.renderChart();
        this.centerView();
    }

    loadOrgData() {
        const dataScript = document.getElementById('org-data');
        if (dataScript) {
            this.orgData = JSON.parse(dataScript.textContent);
        }
    }

    setupEventListeners() {
        // Zoom controls
        document.getElementById('zoom-in-btn').addEventListener('click', () => this.zoomIn());
        document.getElementById('zoom-out-btn').addEventListener('click', () => this.zoomOut());
        document.getElementById('reset-view-btn').addEventListener('click', () => this.resetView());
        
        // Expand/Collapse controls
        document.getElementById('expand-all-btn').addEventListener('click', () => this.expandAll());
        document.getElementById('collapse-all-btn').addEventListener('click', () => this.collapseAll());
        
        // Search
        const searchInput = document.getElementById('org-search');
        searchInput.addEventListener('input', (e) => this.handleSearch(e.target.value));
        
        // Mouse events for pan/zoom
        this.svg.addEventListener('mousedown', (e) => this.handleMouseDown(e));
        this.svg.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        this.svg.addEventListener('mouseup', () => this.handleMouseUp());
        this.svg.addEventListener('wheel', (e) => this.handleWheel(e));
        
        // Modal events
        document.getElementById('close-modal').addEventListener('click', () => this.closeModal());
        document.getElementById('employee-modal').addEventListener('click', (e) => {
            if (e.target.id === 'employee-modal') this.closeModal();
        });
        
        // Prevent context menu
        this.svg.addEventListener('contextmenu', (e) => e.preventDefault());
    }

    buildHierarchy() {
        // Find root node (CEO)
        const rootId = 'ceo';
        this.hierarchy = this.buildNode(rootId, 0, 0);
        this.calculatePositions(this.hierarchy);
    }

    buildNode(nodeId, level, index) {
        const nodeData = this.orgData[nodeId];
        if (!nodeData) return null;

        const node = {
            id: nodeId,
            data: nodeData,
            level: level,
            index: index,
            children: [],
            x: 0,
            y: 0,
            width: 0
        };

        // Build children
        if (nodeData.reports && nodeData.reports.length > 0) {
            nodeData.reports.forEach((childId, childIndex) => {
                const child = this.buildNode(childId, level + 1, childIndex);
                if (child) {
                    node.children.push(child);
                }
            });
        }

        return node;
    }

    calculatePositions(node, parentX = 0) {
        if (!node) return 0;

        // Calculate total width needed for all children
        let totalChildWidth = 0;
        node.children.forEach(child => {
            totalChildWidth += this.calculatePositions(child);
        });

        // Node's own width is either its children's width or minimum node width
        node.width = Math.max(totalChildWidth, this.nodeWidth + this.siblingMargin);

        // Position children
        let currentX = parentX - node.width / 2;
        node.children.forEach(child => {
            child.x = currentX + child.width / 2;
            child.y = node.level * this.levelHeight + this.levelHeight;
            currentX += child.width;
        });

        // Position this node
        node.x = parentX;
        node.y = node.level * this.levelHeight;

        return node.width;
    }

    renderChart() {
        this.clearChart();
        
        // Get chart bounds for centering
        const bounds = this.getChartBounds(this.hierarchy);
        
        // Render connections first (so they appear behind nodes)
        this.renderConnections(this.hierarchy);
        
        // Render nodes
        this.renderNodes(this.hierarchy);
        
        // Update SVG viewBox
        this.updateViewBox(bounds);
    }

    clearChart() {
        this.nodesGroup.innerHTML = '';
        this.connectionsGroup.innerHTML = '';
    }

    renderNodes(node) {
        if (!node) return;

        // Create node group
        const nodeGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
        nodeGroup.setAttribute('class', 'org-node');
        nodeGroup.setAttribute('data-id', node.id);
        nodeGroup.setAttribute('transform', `translate(${node.x}, ${node.y})`);

        // Node background
        const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        rect.setAttribute('x', -this.nodeWidth / 2);
        rect.setAttribute('y', -this.nodeHeight / 2);
        rect.setAttribute('width', this.nodeWidth);
        rect.setAttribute('height', this.nodeHeight);
        rect.setAttribute('rx', '8');
        rect.setAttribute('fill', node.data.isDepartment ? '#f3f4f6' : 'url(#nodeGradient)');
        rect.setAttribute('stroke', node.data.isDepartment ? '#d1d5db' : '#e5e7eb');
        rect.setAttribute('stroke-width', '1');
        rect.setAttribute('filter', 'url(#dropshadow)');
        nodeGroup.appendChild(rect);

        if (!node.data.isDepartment) {
            // Avatar circle
            const avatarGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            const avatarCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            avatarCircle.setAttribute('cx', -this.nodeWidth / 2 + 35);
            avatarCircle.setAttribute('cy', 0);
            avatarCircle.setAttribute('r', '20');
            avatarCircle.setAttribute('fill', '#e5e7eb');
            avatarCircle.setAttribute('stroke', '#d1d5db');
            avatarCircle.setAttribute('stroke-width', '2');
            avatarGroup.appendChild(avatarCircle);

            // Avatar image (placeholder for now)
            const avatarText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            avatarText.setAttribute('x', -this.nodeWidth / 2 + 35);
            avatarText.setAttribute('y', 5);
            avatarText.setAttribute('text-anchor', 'middle');
            avatarText.setAttribute('font-size', '12');
            avatarText.setAttribute('fill', '#6b7280');
            avatarText.textContent = node.data.name.charAt(0);
            avatarGroup.appendChild(avatarText);

            nodeGroup.appendChild(avatarGroup);

            // Name
            const nameText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            nameText.setAttribute('x', -this.nodeWidth / 2 + 75);
            nameText.setAttribute('y', -8);
            nameText.setAttribute('font-size', '14');
            nameText.setAttribute('font-weight', '600');
            nameText.setAttribute('fill', '#1f2937');
            nameText.textContent = this.truncateText(node.data.name, 18);
            nodeGroup.appendChild(nameText);

            // Position
            const positionText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            positionText.setAttribute('x', -this.nodeWidth / 2 + 75);
            positionText.setAttribute('y', 8);
            positionText.setAttribute('font-size', '12');
            positionText.setAttribute('fill', '#6b7280');
            positionText.textContent = this.truncateText(node.data.position, 22);
            nodeGroup.appendChild(positionText);
        } else {
            // Department node styling
            const deptText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            deptText.setAttribute('x', 0);
            deptText.setAttribute('y', 0);
            deptText.setAttribute('text-anchor', 'middle');
            deptText.setAttribute('font-size', '14');
            deptText.setAttribute('font-weight', '600');
            deptText.setAttribute('fill', '#374151');
            deptText.textContent = node.data.position;
            nodeGroup.appendChild(deptText);
        }

        // Expand/collapse button for nodes with children
        if (node.children.length > 0) {
            const isExpanded = this.expandedNodes.has(node.id);
            const buttonGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            buttonGroup.setAttribute('class', 'expand-button');
            buttonGroup.setAttribute('transform', `translate(${this.nodeWidth / 2 - 15}, ${this.nodeHeight / 2 - 15})`);

            const buttonCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            buttonCircle.setAttribute('cx', 0);
            buttonCircle.setAttribute('cy', 0);
            buttonCircle.setAttribute('r', '8');
            buttonCircle.setAttribute('fill', '#3b82f6');
            buttonCircle.setAttribute('stroke', '#ffffff');
            buttonCircle.setAttribute('stroke-width', '2');
            buttonGroup.appendChild(buttonCircle);

            const buttonText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            buttonText.setAttribute('x', 0);
            buttonText.setAttribute('y', 3);
            buttonText.setAttribute('text-anchor', 'middle');
            buttonText.setAttribute('font-size', '10');
            buttonText.setAttribute('font-weight', 'bold');
            buttonText.setAttribute('fill', '#ffffff');
            buttonText.textContent = isExpanded ? '−' : '+';
            buttonGroup.appendChild(buttonText);

            nodeGroup.appendChild(buttonGroup);

            // Add click event for expand/collapse
            buttonGroup.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleNode(node.id);
            });
        }

        // Add click event for node details
        if (!node.data.isDepartment) {
            nodeGroup.addEventListener('click', () => this.showEmployeeDetails(node.data));
            nodeGroup.style.cursor = 'pointer';
        }

        this.nodesGroup.appendChild(nodeGroup);

        // Render children if expanded
        if (this.expandedNodes.has(node.id) || node.level === 0) {
            node.children.forEach(child => this.renderNodes(child));
        }
    }

    renderConnections(node) {
        if (!node || !this.expandedNodes.has(node.id) && node.level !== 0) return;

        node.children.forEach(child => {
            if (this.expandedNodes.has(node.id) || node.level === 0) {
                // Create connection line
                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                
                const startX = node.x;
                const startY = node.y + this.nodeHeight / 2;
                const endX = child.x;
                const endY = child.y - this.nodeHeight / 2;
                const midY = startY + (endY - startY) / 2;

                const pathData = `M ${startX} ${startY} 
                                 L ${startX} ${midY} 
                                 L ${endX} ${midY} 
                                 L ${endX} ${endY}`;

                path.setAttribute('d', pathData);
                path.setAttribute('stroke', '#94a3b8');
                path.setAttribute('stroke-width', '2');
                path.setAttribute('fill', 'none');
                path.setAttribute('marker-end', 'url(#arrowhead)');

                this.connectionsGroup.appendChild(path);

                // Recursively render child connections
                this.renderConnections(child);
            }
        });
    }

    toggleNode(nodeId) {
        if (this.expandedNodes.has(nodeId)) {
            this.expandedNodes.delete(nodeId);
        } else {
            this.expandedNodes.add(nodeId);
        }
        
        this.renderChart();
    }

    expandAll() {
        this.visitAllNodes(this.hierarchy, (node) => {
            if (node.children.length > 0) {
                this.expandedNodes.add(node.id);
            }
        });
        this.renderChart();
    }

    collapseAll() {
        this.expandedNodes.clear();
        this.renderChart();
    }

    visitAllNodes(node, callback) {
        if (!node) return;
        callback(node);
        node.children.forEach(child => this.visitAllNodes(child, callback));
    }

    handleSearch(query) {
        this.searchResults = [];
        
        if (query.trim() === '') {
            this.clearSearchHighlights();
            return;
        }

        // Search through organization data
        Object.values(this.orgData).forEach(employee => {
            if (employee.name.toLowerCase().includes(query.toLowerCase()) ||
                employee.position.toLowerCase().includes(query.toLowerCase())) {
                this.searchResults.push(employee.id);
            }
        });

        this.highlightSearchResults();
        
        if (this.searchResults.length > 0) {
            this.focusOnNode(this.searchResults[0]);
        }
    }

    highlightSearchResults() {
        this.clearSearchHighlights();
        
        this.searchResults.forEach(nodeId => {
            const nodeElement = this.nodesGroup.querySelector(`[data-id="${nodeId}"]`);
            if (nodeElement) {
                const rect = nodeElement.querySelector('rect');
                rect.setAttribute('stroke', '#fbbf24');
                rect.setAttribute('stroke-width', '3');
            }
        });
    }

    clearSearchHighlights() {
        const allNodes = this.nodesGroup.querySelectorAll('.org-node rect');
        allNodes.forEach(rect => {
            rect.setAttribute('stroke', '#e5e7eb');
            rect.setAttribute('stroke-width', '1');
        });
    }

    focusOnNode(nodeId) {
        const node = this.findNodeById(this.hierarchy, nodeId);
        if (node) {
            // Expand path to node
            this.expandPathToNode(this.hierarchy, nodeId);
            
            // Center view on node
            this.panX = -node.x * this.zoomLevel + this.container.offsetWidth / 2;
            this.panY = -node.y * this.zoomLevel + this.container.offsetHeight / 2;
            
            this.renderChart();
            this.updateTransform();
        }
    }

    findNodeById(node, targetId) {
        if (!node) return null;
        if (node.id === targetId) return node;
        
        for (let child of node.children) {
            const found = this.findNodeById(child, targetId);
            if (found) return found;
        }
        
        return null;
    }

    expandPathToNode(node, targetId) {
        if (!node) return false;
        
        if (node.id === targetId) return true;
        
        for (let child of node.children) {
            if (this.expandPathToNode(child, targetId)) {
                this.expandedNodes.add(node.id);
                return true;
            }
        }
        
        return false;
    }

    showEmployeeDetails(employee) {
        const modal = document.getElementById('employee-modal');
        const content = document.getElementById('modal-content');
        
        content.innerHTML = `
            <div class="text-center mb-4">
                <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-3 flex items-center justify-center">
                    <span class="text-2xl font-bold text-gray-600">${employee.name.charAt(0)}</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900">${employee.name}</h4>
                <p class="text-gray-600">${employee.position}</p>
            </div>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm text-gray-900">${employee.email}</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span class="text-sm text-gray-900">${employee.phone}</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="text-sm text-gray-900">${employee.department}</span>
                </div>
            </div>
        `;
        
        modal.classList.remove('hidden');
    }

    closeModal() {
        document.getElementById('employee-modal').classList.add('hidden');
    }

    // Zoom and Pan functionality
    zoomIn() {
        this.zoomLevel = Math.min(this.zoomLevel * 1.2, 3);
        this.updateZoomDisplay();
        this.updateTransform();
    }

    zoomOut() {
        this.zoomLevel = Math.max(this.zoomLevel / 1.2, 0.3);
        this.updateZoomDisplay();
        this.updateTransform();
    }

    resetView() {
        this.zoomLevel = 1;
        this.centerView();
        this.updateZoomDisplay();
        this.updateTransform();
    }

    centerView() {
        const bounds = this.getChartBounds(this.hierarchy);
        this.panX = (this.container.offsetWidth - bounds.width * this.zoomLevel) / 2 - bounds.minX * this.zoomLevel;
        this.panY = (this.container.offsetHeight - bounds.height * this.zoomLevel) / 2 - bounds.minY * this.zoomLevel;
    }

    updateZoomDisplay() {
        document.getElementById('zoom-level').textContent = Math.round(this.zoomLevel * 100) + '%';
    }

    updateTransform() {
        const transform = `translate(${this.panX}px, ${this.panY}px) scale(${this.zoomLevel})`;
        document.getElementById('org-chart-wrapper').style.transform = transform;
    }

    getChartBounds(node) {
        let minX = Infinity, maxX = -Infinity, minY = Infinity, maxY = -Infinity;
        
        this.visitAllNodes(node, (n) => {
            minX = Math.min(minX, n.x - this.nodeWidth / 2);
            maxX = Math.max(maxX, n.x + this.nodeWidth / 2);
            minY = Math.min(minY, n.y - this.nodeHeight / 2);
            maxY = Math.max(maxY, n.y + this.nodeHeight / 2);
        });
        
        return {
            minX,
            maxX,
            minY,
            maxY,
            width: maxX - minX,
            height: maxY - minY
        };
    }

    updateViewBox(bounds) {
        const padding = 100;
        this.svg.setAttribute('viewBox', 
            `${bounds.minX - padding} ${bounds.minY - padding} 
             ${bounds.width + padding * 2} ${bounds.height + padding * 2}`);
    }

    // Mouse event handlers
    handleMouseDown(e) {
        if (e.button === 0) { // Left mouse button
            this.isDragging = true;
            this.dragStart = { x: e.clientX - this.panX, y: e.clientY - this.panY };
            this.svg.style.cursor = 'grabbing';
        }
    }

    handleMouseMove(e) {
        if (this.isDragging) {
            this.panX = e.clientX - this.dragStart.x;
            this.panY = e.clientY - this.dragStart.y;
            this.updateTransform();
        }
    }

    handleMouseUp() {
        this.isDragging = false;
        this.svg.style.cursor = 'grab';
    }

    handleWheel(e) {
        e.preventDefault();
        
        const rect = this.svg.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        const mouseY = e.clientY - rect.top;
        
        const oldZoom = this.zoomLevel;
        
        if (e.deltaY < 0) {
            this.zoomLevel = Math.min(this.zoomLevel * 1.1, 3);
        } else {
            this.zoomLevel = Math.max(this.zoomLevel / 1.1, 0.3);
        }
        
        // Zoom towards mouse position
        const zoomRatio = this.zoomLevel / oldZoom;
        this.panX = mouseX - (mouseX - this.panX) * zoomRatio;
        this.panY = mouseY - (mouseY - this.panY) * zoomRatio;
        
        this.updateZoomDisplay();
        this.updateTransform();
    }

    truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }
}

// Initialize the organizational chart when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('org-chart-container')) {
        window.orgChart = new OrganizationalChart('org-chart-container');
    }
});
