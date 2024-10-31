
# Servidor SOAP para Gestión de Monederos y Clientes

Este proyecto es un servidor SOAP desarrollado en Laravel que permite realizar varias operaciones relacionadas con la gestión de clientes y monederos. 

## Funcionalidades

El servidor SOAP incluye las siguientes operaciones:

- **Registrar Cliente:** Permite registrar un nuevo cliente.
- **Consultar Saldo:** Permite consultar el saldo de un cliente.
- **Realizar Pago:** Permite realizar un pago desde el monedero del cliente.
- **Confirmar Pago:** Permite confirmar un pago realizado.
- **Recargar Monedero:** Permite recargar el saldo del monedero de un cliente.

## Requisitos 

- PHP 8.0 o superior
- Composer
- Laravel 11

## Instalación

1. **Clona el repositorio:**

   ```bash
   git clone git@github.com:rodriguezrod1/soap-service.git
   cd soap-service
   ```

2. **Instala las dependencias:**

   Asegúrate de tener Composer instalado en tu máquina, luego ejecuta:

   ```bash
   composer install
   ```

3. **Configura el archivo `.env`:**

   Copia el archivo de entorno de ejemplo y renómbralo:
   
   ```bash
   cp .env.example .env
   ```

   Edita el archivo `.env` para configurar la conexión a la base de datos y otros parámetros.

4. **Genera la clave de la aplicación:**

   ```bash
   php artisan key:generate
   ```

5. **Inicia el servidor:**

   Puedes ejecutar el servidor embebido de Laravel para propósitos de desarrollo:

   ```bash
   php artisan queue:table
   php artisan migrate
   php artisan serve
   ```

   Tu servidor SOAP estará disponible en `http://localhost:8000/soap`.

## Endpoints

### 1. SOAP

- **URL:** `/soap`
- **Método:** `POST`
- **Contenido de la solicitud:** Se espera que la solicitud sea un mensaje SOAP que incluya uno de los métodos disponibles (`registerClient`, `checkBalance`, `makePayment`, `confirmPayment`, `rechargeWallet`).

### Ejemplo de Solicitud SOAP

Aquí hay un ejemplo de cómo podría verse una solicitud SOAP para registrar un cliente:

```xml
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <registerClient xmlns="http://tempuri.org/">
            <document>123456789</document>
            <names>Juan Pérez</names>
            <email>juan@example.com</email>
            <phone>1234567890</phone>
        </registerClient>
    </soap:Body>
</soap:Envelope>
```

## Manejo de Errores

Los errores generados por el servidor SOAP se devolverán como un mensaje de error SOAP. Cualquier excepción manejará errores internos y retornará un mensaje de error correspondiente.

## Licencia

Este proyecto está bajo la Licencia MIT.


