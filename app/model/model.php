<?php
require_once 'config.php';
    class Model {
        protected $db;

        function __construct() {
            // Conexión al servidor MySQL sin especificar una base de datos
            $this->db = new PDO('mysql:host='. MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            // Crear la base de datos si no existe
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8 COLLATE utf8_general_ci");
            // Conectarse a la base de datos recién creada
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
          }

          function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables)==0) {
                $sql =<<<END
                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";

                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;


                CREATE TABLE `categorias` (
                    `id` int(11) NOT NULL,
                    `nombre` varchar(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
                
                --
                -- Volcado de datos para la tabla `categorias`
                --
                
                INSERT INTO `categorias` (`id`, `nombre`) VALUES
                (1, 'Verduleria'),
                (2, 'Dietetica'),
                (3, 'Carniceria'),
                (4, 'Bebidas');
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `medidas`
                --
                
                CREATE TABLE `medidas` (
                    `id` int(11) NOT NULL,
                    `unidad_medida` varchar(150) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
                
                --
                -- Volcado de datos para la tabla `medidas`
                --
                
                INSERT INTO `medidas` (`id`, `unidad_medida`) VALUES
                (1, 'KG'),
                (2, 'PACKS'),
                (3, 'UND'),
                (4, 'GRS');
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `productos`
                --
                
                CREATE TABLE `productos` (
                    `id` int(11) NOT NULL,
                    `nombre` varchar(150) NOT NULL,
                    `id_unidad_medida` int(11) NOT NULL,
                    `id_categoria` int(11) NOT NULL,
                    `id_proveedor` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
                
                --
                -- Volcado de datos para la tabla `productos`
                --
                
                INSERT INTO `productos` (`id`, `nombre`, `id_unidad_medida`, `id_categoria`, `id_proveedor`) VALUES
                (1, 'Latas de cerveza', 2, 4, 1),
                (2, 'Sal', 1, 2, 2),
                (3, 'Rosca de chorizo', 3, 3, 3);
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `proveedores`
                --
                
                CREATE TABLE `proveedores` (
                    `id` int(11) NOT NULL,
                    `nombre` varchar(150) NOT NULL,
                    `cuil_cuit` varchar(150) NOT NULL,
                    `ciudad` varchar(150) NOT NULL,
                    `telefono` bigint(20) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
                
                --
                -- Volcado de datos para la tabla `proveedores`
                --
                
                INSERT INTO `proveedores` (`id`, `nombre`, `cuil_cuit`, `ciudad`, `telefono`) VALUES
                (1, 'Beertan', '28-48757923-9', 'Tandil', 2494029921),
                (2, 'TPG', '20-41103096-3', 'Mar del plata', 2234872345),
                (3, 'El rencuentro', '21-6958754-9', 'Tandil', 2494029921),
                (4, 'Porc', '24-9865875-98', 'Tandil', 2494242328);
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `usuarios`
                --
                
                CREATE TABLE `usuarios` (
                    `id` int(11) NOT NULL,
                    `usuario` varchar(255) NOT NULL,
                    `contraseña` varchar(255) NOT NULL,
                    `mail` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `usuarios`
                --
                
                INSERT INTO `usuarios` (`id`, `usuario`, `contraseña`, `mail`) VALUES
                (1, 'webadmin', 'admin', 'web2@tudai.com');
                
                --
                -- Índices para tablas volcadas
                --
                
                --
                -- Indices de la tabla `categorias`
                --
                ALTER TABLE `categorias`
                    ADD PRIMARY KEY (`id`);
                
                --
                -- Indices de la tabla `medidas`
                --
                ALTER TABLE `medidas`
                    ADD PRIMARY KEY (`id`);
                
                --
                -- Indices de la tabla `productos`
                --
                ALTER TABLE `productos`
                    ADD PRIMARY KEY (`id`),
                    ADD KEY `id_categoria` (`id_categoria`),
                    ADD KEY `id_categoria_2` (`id_categoria`,`id_proveedor`),
                    ADD KEY `id_proveedor` (`id_proveedor`),
                    ADD KEY `id_unidad_medida` (`id_unidad_medida`);
                
                --
                -- Indices de la tabla `proveedores`
                --
                ALTER TABLE `proveedores`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE KEY `cuil_cuit` (`cuil_cuit`);
                
                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE KEY `mail` (`mail`);
                
                --
                -- AUTO_INCREMENT de las tablas volcadas
                --
                
                --
                -- AUTO_INCREMENT de la tabla `categorias`
                --
                ALTER TABLE `categorias`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
                
                --
                -- AUTO_INCREMENT de la tabla `medidas`
                --
                ALTER TABLE `medidas`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
                
                --
                -- AUTO_INCREMENT de la tabla `productos`
                --
                ALTER TABLE `productos`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
                
                --
                -- AUTO_INCREMENT de la tabla `proveedores`
                --
                ALTER TABLE `proveedores`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
                
                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
                
                --
                -- Restricciones para tablas volcadas
                --
                
                --
                -- Filtros para la tabla `productos`
                --
                ALTER TABLE `productos`
                    ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
                    ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`),
                    ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_unidad_medida`) REFERENCES `medidas` (`id`);
                COMMIT;
                
                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                END;
                $this->db->query($sql);
            }
        }
    }