#  🛒Supermercado🛒

## Integrantes:
* Montani Victorio.
* Souza Julian.

## Descripcion del Tp 📋
Vamos a realizar una base de datos para un supermecado y asi poder llevar a cabo un control de los productos, las unidades de medida, la categoria de los productos y los proveedores.

## Diagrama de la DB
![89291308-3188-41ff-a7b7-ef78e332395f](https://github.com/user-attachments/assets/b8f9009e-b31d-4e7c-921b-5c9490583573)



## Endpoints

- **GET** `/api/proveedores`  
  Devuelve todos los proveedores disponibles en la base de datos, permitiendo opcionalmente aplicar filtrado y ordenamiento a los resultados.

  - **Query Params**:  
    - **Ordenamiento**:  
      - `orderby`
        - `nombre`
        - `cuil_cuit`
        - `ciudad`
        - `telefono`
      
      - `direccion`: Dirección de orden para el campo especificado en `orderby`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.
  
      **Ejemplo de Ordenamiento**:  
      Para obtener todos los proveedores ordenados por ciudad en orden descendente:
      ```http
      GET /api/proveedores?orderby=ciudad&direccion=DESC
      ```

---

- **GET** `/api/proveedores/:ID`  
  Devuelve el proveedor correspondiente al `ID` solicitado.

---

- **POST** `/api/proveedores`  
  Inserta un nuevo proveedor con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - **Campos requeridos**:  
    - `nombre`
    - `cuil_cuit`
    - `ciudad`
    - `telefono`
      
   **Ejemplo de json a insertar**:
  

    ```json
    {
      "nombre": "Julian Souza",
      "cuil_cuit": "20-41103096-3",
      "ciudad": "Tandil",
      "telefono": 2494242328
    }

---

- **PUT** `/api/proveedores/:ID`  
  Modifica el proveedor correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:  
    - `nombre`  
    - `cuil_cuit`  
    - `ciudad`  
    - `telefono`

---

- **DELETE** `/api/proveedores/:ID`  
  Elimina el proveedor correspondiente al `ID` solicitado.
