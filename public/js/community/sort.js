document.addEventListener('DOMContentLoaded', function() {
    function sortMembers(sortType) {
        const membersContainer = document.getElementById('members-container');
        const members = Array.from(membersContainer.querySelectorAll('.member-item'));

        const validMembers = members.filter(member => {
            const percentage = member.dataset.percentage;
            return percentage !== '' && percentage !== null;
        });

        validMembers.sort((a, b) => {
            if (sortType === 'percentage') {
                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
            } else if (sortType === 'date') {
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            }
            return 0;
        });
    }

    document.getElementById('sort-interest').addEventListener('click', function() {
        sortMembers('percentage');
    });

    document.getElementById('sort-date').addEventListener('click', function() {
        sortMembers('date');
    });
});