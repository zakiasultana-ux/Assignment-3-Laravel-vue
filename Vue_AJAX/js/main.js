const BASE_URL = 'http://127.0.0.1:8000/api';

async function apiFetch(url) {
    let res;
    try {
        res = await fetch(url);
    } catch (networkErr) {
        throw new Error('Cannot reach the API server. Is the Laravel backend running?');
    }
    const contentType = res.headers.get('Content-Type') || '';
    if (!contentType.includes('application/json')) {
        throw new Error(`Server returned non-JSON response (HTTP ${res.status}). Is the backend running and CORS configured?`);
    }
    const json = await res.json();
    if (!res.ok) {
        throw new Error(json.message || `Server error: ${res.status}`);
    }
    return json;
}

const app = Vue.createApp({
    data() {
        return {
            // Friends data
            activeTab: 'episodes',

            // Episodes
            allEpisodes: [],
            filteredEpisodes: [],
            loadingEpisodes: true,
            episodeError: null,
            selectedEpisode: null,
            loadingEpisodeDetail: false,
            episodeDetailError: null,
            episodeSearch: '',
            episodeSeason: '',
            episodeMinRating: '',
            episodeCharacterId: '',

            // Characters
            allCharacters: [],
            filteredCharacters: [],
            mainCharacters: [],
            loadingCharacters: true,
            characterError: null,
            selectedCharacter: null,
            loadingCharacterDetail: false,
            characterDetailError: null,
            characterSearch: '',
            characterOccupation: '',
            characterActor: '',

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
        this.fetchEpisodes();
        this.fetchCharacters();
    },

    methods: {
        // ── Tab switching ────────────────────────────
        switchTab(tab) {
            this.activeTab = tab;
        },

        // EPISODES
        fetchEpisodes() {
            this.loadingEpisodes = true;
            this.episodeError = null;
            apiFetch(`${BASE_URL}/episodes`)
                .then(json => {
                    this.allEpisodes = json.data || [];
                    this.filteredEpisodes = [...this.allEpisodes];
                    this.$nextTick(() => this.animateList(this.$refs.episodeList, '.episode-card'));
                })
                .catch(err => { this.episodeError = err.message; })
                .finally(() => { this.loadingEpisodes = false; });
        },
        filterEpisodes() {
            const params = new URLSearchParams();
            if (this.episodeSearch)      params.set('search', this.episodeSearch);
            if (this.episodeSeason)      params.set('season', this.episodeSeason);
            if (this.episodeMinRating)   params.set('min_rating', this.episodeMinRating);
            if (this.episodeCharacterId) params.set('featured_character_id', this.episodeCharacterId);
            this.episodeError = null;
            apiFetch(`${BASE_URL}/episodes?${params.toString()}`)
                .then(json => {
                    this.filteredEpisodes = json.data || [];
                    this.$nextTick(() => this.animateList(this.$refs.episodeList, '.episode-card'));
                })
                .catch(err => { this.episodeError = err.message; });
        },

        selectEpisode(id) {
            this.loadingEpisodeDetail = true;
            this.episodeDetailError = null;
            this.selectedEpisode = null;
            apiFetch(`${BASE_URL}/episodes/${id}`)
                .then(json => {
                    if (!json.data) throw new Error('Episode not found.');
                    this.selectedEpisode = json.data;
                    this.$nextTick(() => {
                        const panel = this.$refs.episodeDetail;
                        if (panel) {
                            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            gsap.fromTo(panel,
                                { opacity: 0, y: 30 },
                                { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
                            );
                        }
                    });
                })
                .catch(err => { this.episodeDetailError = err.message; })
                .finally(() => { this.loadingEpisodeDetail = false; });
        },

        // CHARACTERS
        fetchCharacters() {
            this.loadingCharacters = true;
            this.characterError = null;
            apiFetch(`${BASE_URL}/characters`)
                .then(json => {
                    this.allCharacters = json.data || [];
                    this.filteredCharacters = [...this.allCharacters];
                    // First 6 are the seeded main cast — use for dropdown
                    this.mainCharacters = this.allCharacters.slice(0, 6);
                    this.$nextTick(() => this.animateList(this.$refs.characterGrid, '.char-card'));
                })
                .catch(err => { this.characterError = err.message; })
                .finally(() => { this.loadingCharacters = false; });
        },

        filterCharacters() {
            const params = new URLSearchParams();
            if (this.characterSearch)     params.set('search', this.characterSearch);
            if (this.characterOccupation) params.set('occupation', this.characterOccupation);
            if (this.characterActor)      params.set('actor_name', this.characterActor);
            this.characterError = null;
            apiFetch(`${BASE_URL}/characters?${params.toString()}`)
                .then(json => {
                    this.filteredCharacters = json.data || [];
                    this.$nextTick(() => this.animateList(this.$refs.characterGrid, '.char-card'));
                })
                .catch(err => { this.characterError = err.message; });
        },

        selectCharacter(id) {
            this.loadingCharacterDetail = true;
            this.characterDetailError = null;
            this.selectedCharacter = null;
            apiFetch(`${BASE_URL}/characters/${id}`)
                .then(json => {
                    if (!json.data) throw new Error('Character not found.');
                    this.selectedCharacter = json.data;
                    this.$nextTick(() => {
                        const panel = this.$refs.characterDetail;
                        if (panel) {
                            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            gsap.fromTo(panel,
                                { opacity: 0, y: 30 },
                                { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
                            );
                        }
                    });
                })
                .catch(err => { this.characterDetailError = err.message; })
                .finally(() => { this.loadingCharacterDetail = false; });
        },

        viewCharacterFromEpisode(character) {
            this.switchTab('characters');
            this.$nextTick(() => this.selectCharacter(character.id));
        },

        switchToEpisode(ep) {
            this.switchTab('episodes');
            this.$nextTick(() => this.selectEpisode(ep.id));
        },

        // GSAP animations
        animateList(parentRef, childSelector) {
            if (!parentRef) return;
            const items = parentRef.querySelectorAll(childSelector);
            if (!items.length) return;
            gsap.fromTo(items,
                { opacity: 0, y: 15 },
                { opacity: 1, y: 0, duration: 0.35, stagger: 0.04, ease: 'power1.out' }
            );
        },

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
        },

    }
}).mount("#app");
