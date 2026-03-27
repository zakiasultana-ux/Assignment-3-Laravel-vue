# Assignment-3-Laravel-vue
the basic concepts of connecting a Vue.js frontend to a Laravel API they will create in their web development class.

## Friends TV Show — Laravel REST API

A RESTful Laravel API for the TV series **Friends** (NBC, 1994–2004).

Two resources are exposed:
- **Characters** — the people of Friends (main cast + recurring)
- **Episodes**  — all episodes across the 10 seasons

---

## Setup

```bash
cp .env.example .env
composer install
php artisan key:generate

# Configure DB_* in .env, then:
php artisan migrate
php artisan db:seed
```

The seeder inserts:
- **6 main-cast characters** (Ross, Rachel, Monica, Chandler, Joey, Phoebe) with real data
- **14 randomised recurring characters** via factory
- **21 real Friends episodes** with accurate titles, air dates and IMDb ratings
- **59 randomised episodes** via factory (total ≈ 80)
- Every episode is linked to all 6 main-cast characters + a random subset of recurring ones

---

## API Endpoints

### Base URL: `/api`

---

### Characters

| Method   | URL                      | Description                                  |
|----------|--------------------------|----------------------------------------------|
| `GET`    | `/api/characters`        | List all characters (supports filters)       |
| `POST`   | `/api/characters`        | Create a new character                       |
| `GET`    | `/api/characters/{id}`   | Show a single character with their episodes  |
| `PATCH`  | `/api/characters/{id}`   | Update a character (only supplied fields)    |
| `DELETE` | `/api/characters/{id}`   | Soft-delete a character                      |

#### Filters for `GET /api/characters`

| Parameter      | Type    | Description                                           |
|----------------|---------|-------------------------------------------------------|
| `name`         | string  | Partial, case-insensitive search on character name    |
| `portrayed_by` | string  | Partial, case-insensitive search on actor name        |
| `is_main_cast` | boolean | `1` / `0` — filter by main cast membership           |
| `occupation`   | string  | Partial search on occupation field                    |

**Examples:**
```
GET /api/characters?is_main_cast=1
GET /api/characters?name=Ross
GET /api/characters?portrayed_by=Jennifer
GET /api/characters?occupation=Chef
```

#### `POST /api/characters` body

```json
{
    "name":         "Gunther",
    "portrayed_by": "James Michael Tyler",
    "occupation":   "Central Perk Manager",
    "description":  "The lovesick manager of Central Perk, secretly in love with Rachel.",
    "is_main_cast": false
}
```

---

### Episodes

| Method   | URL                    | Description                                         |
|----------|------------------------|-----------------------------------------------------|
| `GET`    | `/api/episodes`        | List all episodes (supports filters)                |
| `POST`   | `/api/episodes`        | Create a new episode                                |
| `GET`    | `/api/episodes/{id}`   | Show a single episode with its characters           |
| `PATCH`  | `/api/episodes/{id}`   | Update an episode (only supplied fields)            |
| `DELETE` | `/api/episodes/{id}`   | Soft-delete an episode                              |

#### Filters for `GET /api/episodes`

| Parameter        | Type    | Description                                              |
|------------------|---------|----------------------------------------------------------|
| `title`          | string  | Partial, case-insensitive search on episode title        |
| `season`         | integer | Filter by exact season number (1–10)                     |
| `min_rating`     | float   | Episodes with `imdb_rating >=` this value                |
| `max_rating`     | float   | Episodes with `imdb_rating <=` this value                |
| `character_name` | string  | Episodes that feature a character whose name matches     |

**Examples:**
```
GET /api/episodes?season=3
GET /api/episodes?title=embryos
GET /api/episodes?min_rating=9.5
GET /api/episodes?season=1&min_rating=8.0
GET /api/episodes?character_name=Ross
```

#### `POST /api/episodes` body

```json
{
    "title":           "The One with the Holiday Armadillo",
    "season":          7,
    "episode_number":  10,
    "description":     "Ross tries to teach Ben about Hanukkah by dressing as the Holiday Armadillo.",
    "air_date":        "2000-12-14",
    "runtime_minutes": 22,
    "imdb_rating":     9.1,
    "character_ids":   [1, 2, 3, 4, 5, 6]
}
```

---

## Project Structure

```
app/
  Http/Controllers/
    CharacterController.php     CRUD + filters for characters
    EpisodeController.php       CRUD + filters for episodes
  Models/
    Character.php               SoftDeletes, BelongsToMany episodes
    Episode.php                 SoftDeletes, BelongsToMany characters

database/
  factories/
    CharacterFactory.php        Real main cast + faker for recurring
    EpisodeFactory.php          Real episodes + faker for extras
  migrations/
    ..._create_characters_table.php
    ..._create_episodes_table.php
    ..._create_character_episode_table.php  (pivot / join table)
  seeders/
    CharacterSeeder.php
    EpisodeSeeder.php
    DatabaseSeeder.php

routes/
  api.php                       All 10 REST endpoints (no auth)
```

---

## Design Notes

- **Soft Deletes** — both resources use `SoftDeletes`; records are never permanently removed unless force-deleted.
- **Many-to-many** — characters and episodes are linked via a `character_episode` pivot table, reflecting that every episode features multiple characters and every character appears in many episodes.
- **Filters** — each listing endpoint implements ≥ 3 query-string filters (4 on characters, 5 on episodes), applied with `LIKE` for text and exact/range comparisons for numbers.
- **No authentication** — the API is fully open and public.
- **Validation** — `store` and `update` use Laravel's `validate()` helper; invalid input returns `422 Unprocessable Entity`.
- **204 No Content** — `destroy` returns an empty 204 response per REST convention.

## Credits

- Zakia Sultana