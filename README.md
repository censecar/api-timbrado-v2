# API v2.0 CenSeCar

![Logo](https://www.censecar.com.mx/csc/Censecar%20HORIZONTAL.png)

API para el consumo del timbrado WEB por medio de JSON y XML.

## Tech Stack

**Client:** PHP 8.1

**Server:** Unmounted

**Database:** Unmounted

## Authors

- [@hklab13](https://github.com/hklab13)
- [@censecar](https://github.com/censecar)

# API Reference

## URL

[localhost](https://www.censecar.com.mx/)

## Auth (Token)

```http
  GET /auth
```

| Parameter    | Type     | Description   |
|:-------------|:---------|:--------------|
| `usuario`    | `string` | **Required**. |
| `contrasena` | `string` | **Required**. |
| `tiempo`     | `int`    | **Required**. |

### Request / Auth

```json
{
  "usuario": "test",
  "contrasena": "test",
  "tiempo" : 1
}
```

### Response / Auth (Definir)

```json
{
  "status": "ok",
  "result": {
    "token": "a6c056329fafad6bc1e0246524adeXXX"
  }
}
```

## Used By

Este proyecto fue desarrollado para uso y consumo exclusivo para:

- Central de Servicios de Carga de Nuevo Laredo S.A. de C.V.