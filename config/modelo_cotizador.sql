
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `ruc` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(140) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `tipo_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `tipo_producto_id` INT NOT NULL,
  `marca_id` INT NOT NULL,
  `costo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_producto_tipo_producto_idx` (`tipo_producto_id` ASC),
  INDEX `fk_producto_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_producto_tipo_producto`
    FOREIGN KEY (`tipo_producto_id`)
    REFERENCES `tipo_producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `impuesto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `impuesto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` FLOAT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cantidad` INT NOT NULL,
  `producto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_inventario_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_inventario_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cotizacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cotizacion_cliente1_idx` (`cliente_id` ASC),
  INDEX `fk_cotizacion_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_cotizacion_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cotizacion_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `paquete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(140) NOT NULL,
  `costo` FLOAT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `detalle_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_cotizacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cotizacion_id` INT NOT NULL,
  `paquete_id` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio` FLOAT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_detalle_cotizacion_cotizacion1_idx` (`cotizacion_id` ASC),
  INDEX `fk_detalle_cotizacion_paquete1_idx` (`paquete_id` ASC),
  CONSTRAINT `fk_detalle_cotizacion_cotizacion1`
    FOREIGN KEY (`cotizacion_id`)
    REFERENCES `cotizacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_cotizacion_paquete1`
    FOREIGN KEY (`paquete_id`)
    REFERENCES `paquete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producto_paquete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `producto_paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `paquete_id` INT NOT NULL,
  `cantidad_productos` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_producto_paquete_producto1_idx` (`producto_id` ASC),
  INDEX `fk_producto_paquete_paquete1_idx` (`paquete_id` ASC),
  UNIQUE INDEX `pro_paq_unico` (`producto_id` ASC, `paquete_id` ASC),
  CONSTRAINT `fk_producto_paquete_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_paquete_paquete1`
    FOREIGN KEY (`paquete_id`)
    REFERENCES `paquete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

