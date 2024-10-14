document.addEventListener('DOMContentLoaded', function() {
    function sortCompatibility(containerId, sortType) {
        const compatibilityContainer = document.getElementById(containerId);
        const compatibilityItems = Array.from(compatibilityContainer.querySelectorAll('.compatibility-item'));

        compatibilityItems.sort((a, b) => {
            if (sortType === 'compatibility') {
                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
            } else if (sortType === 'date') {
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            }
            return 0;
        });

        compatibilityContainer.innerHTML = ''; // コンテナを空にする

        compatibilityItems.forEach((item) => {
            compatibilityContainer.appendChild(item);
            compatibilityContainer.appendChild(document.createElement('hr'));
        });
    }

    // Reacted Profile
    document.getElementById('sort-compatibility').addEventListener('click', function() {
        sortCompatibility('compatibility-container', 'compatibility');
    });

    document.getElementById('sort-date').addEventListener('click', function() {
        sortCompatibility('compatibility-container', 'date');
    });

    // Reacting Profile
    document.getElementById('sort-reacting-compatibility').addEventListener('click', function() {
        sortCompatibility('reacting-compatibility-container', 'compatibility');
    });

    document.getElementById('sort-reacting-date').addEventListener('click', function() {
        sortCompatibility('reacting-compatibility-container', 'date');
    });
});
