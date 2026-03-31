const app = Vue.createApp({
    data() {
        return {
            // Friends data
            activeTab: 'characters',
            characters: [],
            episodes: [],
            relationships: [],

            // Books data
            booksData: [],
            selectedBooks: null,

            // States
            loading: {
                characters: true,
                episodes: false,
                relationships: false,
                books: true,
                bookDetails: false
            },

            error: {
                characters: null,
                episodes: null,
                relationships: null,
                books: null
            },

            selectedChar: null
        };
    },

    created() {
        // Initial loads
        this.fetchData('characters');
        this.getBooks();
    },

    watch: {
        // Lazy load tabs
        activeTab(tab) {
            if (tab === 'episodes' && !this.episodes.length) {
                this.fetchData('episodes');
            }
            if (tab === 'relationships' && !this.relationships.length) {
                this.fetchData('relationships');
            }
        }
    },

    methods: {

        // ── Generic API fetch (Friends) ─────────────
        fetchData(resource) {
            this.loading[resource] = true;
            this.error[resource] = null;

            fetch(`http://localhost/friends/public/api/${resource}`)
                .then(res => {
                    if (!res.ok) throw new Error(`Failed to fetch ${resource}`);
                    return res.json();
                })
                .then(data => {
                    this[resource] = data.data ?? data;
                })
                .catch(err => {
                    this.error[resource] = err.message;
                })
                .finally(() => {
                    this.loading[resource] = false;
                });
        },

        // ── Books list ─────────────
        getBooks() {
            this.loading.books = true;
            this.error.books = null;

            fetch("http://xp-bar.ca/api/books")
                .then(res => {
                    if (!res.ok) throw new Error('Failed to fetch books');
                    return res.json();
                })
                .then(books => {
                    this.booksData = books.data;
                })
                .catch(err => {
                    this.error.books = err.message;
                })
                .finally(() => {
                    this.loading.books = false;
                });
        },

        // ── Book details ─────────────
        getBook(id) {
            this.loading.bookDetails = true;
            this.selectedBooks = null;
            this.error.books = null;

            fetch(`http://xp-bar.ca/api/books/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Failed to fetch book details');
                    return res.json();
                })
                .then(book => {
                    const data = book.data;

                    if (!data) {
                        throw new Error('Book not found');
                    }

                    this.selectedBooks = {
                        author: data.author?.name || "Not available",
                        published: data.published || "Not available",
                        description: data.description || "Not available",
                        image_url: data.image_url || ""
                    };

                    // Scroll + animation
                    this.$nextTick(() => {
                        window.scrollTo({
                            top: document.body.scrollHeight,
                            behavior: 'smooth'
                        });

                        if (window.gsap && this.$refs.bookInfoCon) {
                            gsap.from(this.$refs.bookInfoCon, {
                                opacity: 0,
                                y: 20,
                                duration: 1
                            });
                        }
                    });
                })
                .catch(err => {
                    this.error.books = err.message;
                })
                .finally(() => {
                    this.loading.bookDetails = false;
                });
        },

        // ── Helpers ─────────────
        initials(name) {
            return name.split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
        },

        parsedPersonality(p) {
            if (!p) return [];
            if (Array.isArray(p)) return p;
            try { return JSON.parse(p); }
            catch { return p.split(',').map(s => s.trim()); }
        },

        ratingStars(r) {
            const full = Math.round(r / 2);
            return '★'.repeat(full) + '☆'.repeat(5 - full);
        },

        relationIcon(status) {
            const map = {
                'Romantic': '💕',
                'Married': '💍',
                'Best Friends': '🤝',
                'Siblings': '👫',
                'Close Friends': '💛',
            };
            return map[status] || '🙂';
        },

        // ── Modal ─────────────
        openModal(char) {
            this.selectedChar = char;
        },

        closeModal() {
            this.selectedChar = null;
        }
    }
}).mount("#app");