
    <script>
        // আরও মেনু টগল
        const moreBtn = document.getElementById('moreBtn');
        const moreDropdown = document.getElementById('moreDropdown');
        const overlay = document.getElementById('moreOverlay');

        moreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            moreDropdown.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        // বাইরে ক্লিক করলে বন্ধ
        overlay.addEventListener('click', function() {
            moreDropdown.classList.remove('active');
            overlay.classList.remove('active');
        });

        // অন্য ন্যাভ আইটেমে ক্লিক করলে মেনু বন্ধ
        document.querySelectorAll('.bottom-nav > a.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                moreDropdown.classList.remove('active');
                overlay.classList.remove('active');
            });
        });

        // Active state for main nav items
        document.querySelectorAll('.bottom-nav > a.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!this.closest('.more-menu-wrapper')) {
                    document.querySelectorAll('.bottom-nav > a.nav-item, .bottom-nav > .nav-item').forEach(nav => {
                        nav.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });





        
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>