# Friends TV Series — Laravel REST API

A RESTful Laravel API for two resources from the **Friends** TV Series:
**Characters** and **Episodes**. No authentication required.

---

## Resources

| Resource     | Description |
|--------------|-------------|
| `characters` | The 6 main cast members + supporting characters |
| `episodes`   | All episodes across 10 seasons |

### Relationship
An **Episode** has an optional `featured_character_id` (belongs to a **Character**).
A **Character** `hasMany` episodes as the featured character.

---

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
# configure DB_* values in .env
php artisan migrate --seed
php artisan serve
```

API root: `http://localhost:8000/api`

---

## Endpoints & Filters

### Characters

| Method | Endpoint | Action |
|--------|----------|--------|
| GET    | `/api/characters` | List all (filterable) |
| POST   | `/api/characters` | Create |
| GET    | `/api/characters/{id}` | Single + their episodes |
| PATCH  | `/api/characters/{id}` | Update |
| DELETE | `/api/characters/{id}` | Soft-delete |

**Filters (Filter 1–3):**
- `?search=` — searches name, actor_name, bio, catchphrase
- `?occupation=` — partial match on occupation
- `?actor_name=` — partial match on actor name

### Episodes

| Method | Endpoint | Action |
|--------|----------|--------|
| GET    | `/api/episodes` | List all (filterable) |
| POST   | `/api/episodes` | Create |
| GET    | `/api/episodes/{id}` | Single + featured character |
| PATCH  | `/api/episodes/{id}` | Update |
| DELETE | `/api/episodes/{id}` | Soft-delete |

**Filters (Filter 4–7):**
- `?search=` — searches title, description, director
- `?season=` — exact season number (1–10)
- `?min_rating=` — minimum IMDB rating
- `?featured_character_id=` — filter by featured character

---

## Seeded Data
- 6 main characters (static) + 10 via factory
- 15 iconic episodes (static) + 50 via factory
