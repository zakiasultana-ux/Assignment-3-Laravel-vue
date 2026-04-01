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
            activeTab: 'characters',

            characters: [],
            selectedChar: null,

            episodes: [],

            relationships: [],

            loading: {
                characters:    true,
                episodes:      false,
                relationships: false,
            },
            error: {
                characters:    null,
                episodes:      null,
                relationships: null,
            },
        };
    },

    created() {
        this.fetchCharacters();
    },

    mounted() {
        gsap.to(this.$refs.eyebrow,   { opacity: 1, y: 0, duration: 0.6, delay: 0.1 });
        gsap.to(this.$refs.heroTitle, { opacity: 1, y: 0, duration: 0.6, delay: 0.3 });
        gsap.to(this.$refs.heroSub,   { opacity: 1, y: 0, duration: 0.6, delay: 0.5 });
    },

    watch: {
        activeTab(tab) {
            if (tab === 'episodes' && this.episodes.length === 0 && !this.loading.episodes) {
                this.fetchEpisodes();
            }
            if (tab === 'relationships' && this.relationships.length === 0 && !this.loading.relationships) {
                this.fetchRelationships();
            }
        }
    },

    methods: {

        switchTab(tab) {
            this.activeTab = tab;
        },

        animateCards(selector) {
            this.$nextTick(() => {
                const cards = document.querySelectorAll(selector);
                if (cards.length === 0) return;
                gsap.to(cards, {
                    opacity: 1,
                    y: 0,
                    x: 0,
                    scale: 1,
                    duration: 0.5,
                    stagger: 0.07,
                    ease: 'power2.out',
                });
            });
        },

        fetchCharacters() {
            this.loading.characters = true;
            this.error.characters   = null;

            apiFetch(`${BASE_URL}/characters`)
                .then(json => {
                    this.characters = json.data || [];
                    this.animateCards('.character-card');
                })
                .catch(err => {
                    this.error.characters = err.message;
                })
                .finally(() => {
                    this.loading.characters = false;
                });
        },

        fetchEpisodes() {
            this.loading.episodes = true;
            this.error.episodes   = null;

            apiFetch(`${BASE_URL}/episodes`)
                .then(json => {
                    this.episodes = json.data || [];
                    this.animateCards('.episode-card');
                })
                .catch(err => {
                    this.error.episodes = err.message;
                })
                .finally(() => {
                    this.loading.episodes = false;
                });
        },

        fetchRelationships() {
            this.loading.relationships = true;
            this.error.relationships   = null;

            apiFetch(`${BASE_URL}/relationships`)
                .then(json => {
                    this.relationships = json.data || [];
                    this.animateCards('.relation-card');
                })
                .catch(err => {
                    this.error.relationships = err.message;
                })
                .finally(() => {
                    this.loading.relationships = false;
                });
        },

        openModal(char) {
            this.selectedChar = char;
        },

        closeModal() {
            this.selectedChar = null;
        },

        initials(name) {
            if (!name) return '?';
            return name.split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
        },

        ratingStars(r) {
            if (r == null) return '☆☆☆☆☆';
            const full = Math.round(r / 2);
            return '★'.repeat(full) + '☆'.repeat(5 - full);
        },

        relationIcon(status) {
            const map = {
                'Romantic':     '💕',
                'Married':      '💍',
                'Best Friends': '🤝',
                'Siblings':     '👫',
                'Close Friends':'💛',
            };
            return map[status] || '🙂';
        },
    }
}).mount('#app');
