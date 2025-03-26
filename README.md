# MealMateTest1
 
# 🥗 MealMate – Aplicație de planificare a dietei

**MealMate** este o aplicație web simplă și intuitivă pentru planificarea meselor și gestionarea alimentelor, rețetelor și listelor de cumpărături. Proiectul este realizat în PHP și MySQL, cu o interfață HTML/CSS.

---

## 🛠️ Funcționalități

- 🔐 Autentificare pentru operatori (admin și utilizatori)
- 📦 Gestionare alimente (adăugare, listare, ștergere)
- 📖 Gestionare rețete (cu alimente + cantități)
- 👤 Gestionare persoane (utilizatori finali)
- 🗓️ Planificare mese (pe zile și tipuri de masă)
- 🛒 Generare automată listă de cumpărături
## 🧪 Date pentru testare

---

### 👤 Utilizatori

| Rol        | Utilizator | Parolă      |
|------------|------------|-------------|
| Admin      | ADM        | admin16#     |
| Operator   | gabriela   | parola123    |

---

## 🗄️ Structură bazei de date (MySQL)

Baza de date: `DietaDB`

Tabele:
- `Alimente`
- `ReteteH` (rețete)
- `ReteteL` (legături rețetă-alimente)
- `Persoane`
- `PlanAlimentar`
- `Operatori`

> Script SQL complet disponibil în fișierul `baza_date_proiect.sql` *(opțional de atașat)*

---

## 💻 Cerințe minime

- Laragon / XAMPP
- PHP ≥ 7.x
- MySQL
- Browser modern

---

## 🚀 Cum rulez aplicația?

1. Clonează sau copiază folderul în `laragon/www/`
2. Creează baza de date `DietaDB` în phpMyAdmin
3. Rulează scriptul SQL pentru a crea tabelele
4. Accesează în browser:

---

## 👩‍💻 Autor

** Florescu Neagoe Alexandra Gabriela**  
Universitatea "Lucian Blaga" din Sibiu  
Fundamente de Antreprenoriat – 2025  
