# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A PHP/MySQL accounting management system (sistema de contabilidad) built for educational purposes. Spanish-language interface running on WAMP stack.

## Running the Project

- Requires WAMP (Windows, Apache, MySQL, PHP) running locally
- Access via: `http://localhost/Proyecto/index.html`
- No build step, no dependencies to install — files run directly on Apache

## Database Setup

Import `tabla.sql` to create the `CONTABILIDAD` database. All PHP files connect with:
```php
$link = mysqli_connect('localhost', 'root', '', 'CONTABILIDAD')
```
No config file — credentials are hardcoded in each PHP file.

## Database Schema

**Database**: `CONTABILIDAD`

| Table | Key Fields |
|---|---|
| `CuentasContables` | `NumCuenta` (PK), `NombreCuenta`, `Tipo` (A/P/C/I/G) |
| `PartidasContables` | `NumPartida` (PK), `Fecha`, `Descripcion` |
| `RegistrosContables` | `NumPartida`+`NumCuenta` (composite PK, FKs), `DebeHaber` (D/H), `Valor` |

The `Tipo` field in `CuentasContables`: A=Activo, P=Pasivo, C=Capital, I=Ingreso, G=Gasto.
The `DebeHaber` field in `RegistrosContables`: D=Debe (debit), H=Haber (credit).

A legacy `Proyecto` database with a `Persona` table exists for older code in the root-level files (`insertar.php`, `listado.php`, etc.) — these are not part of the main accounting system.

## Architecture

Three independent CRUD modules, each following the same file convention:

- `*_forma.html` — static HTML input form (POST to insertar)
- `*_forma.php` — dynamic form that queries the DB (used when dropdowns are needed)
- `*_insertar.php` — handles form POST, inserts record, redirects to listado
- `*_listado.php` — displays all records with edit/delete links
- `*_modificar_forma.php` — pre-fills form with existing record (GET by ID)
- `*_modificar.php` — handles update POST, redirects to listado
- `*_eliminar.php` — handles delete (GET by ID), redirects to listado

**Modules**: `cuentas_*`, `partidas_*`, `registros_*`

The `ejemplo/` folder contains a reference CRUD implementation (Persona entity) used as a template.

## Coding Patterns

All PHP files use **procedural MySQLi** with prepared statements:
```php
$stmt = mysqli_prepare($link, "SELECT ... WHERE NumCuenta = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
```

Output uses `htmlspecialchars()` for display. Integer inputs use `intval()`, floats use `floatval()`.

All pages include `style.css` from the root via relative path `../style.css` (modules) or `style.css` (root).
