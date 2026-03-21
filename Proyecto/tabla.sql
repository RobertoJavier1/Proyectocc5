CREATE DATABASE CONTABILIDAD;

USE CONTABILIDAD;

CREATE TABLE CuentasContables
( NumCuenta integer,
  NombreCuenta varchar(50),
  Tipo char(1),
  PRIMARY KEY(NumCuenta),
  CHECK (Tipo IN ('A','P','C','I','G'))
);

CREATE TABLE PartidasContables
( NumPartida integer,
  Fecha date,
  Descripcion varchar(100),
  PRIMARY KEY (NumPartida)
);

CREATE TABLE RegistrosContables
( NumPartida integer,
  NumCuenta integer,
  DebeHaber char(1),
  Valor Float,
  PRIMARY KEY (NumPartida, NumCuenta),
  FOREIGN KEY (NumPartida) REFERENCES PartidasContables,
  FOREIGN KEY (NumCuenta) REFERENCES CuentasContables,
  CHECK (DebeHaber IN ('D','H'))
);
