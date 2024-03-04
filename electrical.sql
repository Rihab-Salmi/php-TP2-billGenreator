CREATE TABLE Client (
  ID_Client INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE,
  adresse VARCHAR(255)
);

CREATE TABLE Login (
    ID_Login INT PRIMARY KEY AUTO_INCREMENT,
    ID_Client INT,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client)
);

CREATE TABLE Consumption (
    ID_Consumption INT PRIMARY KEY AUTO_INCREMENT,
    ID_Client INT,
    date DATE,
    month INT,
    year INT,
    value float,
    image_meter BLOB,
    annomaly BOOLEAN,
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client)
);
CREATE TABLE Facture (
    ID_Facture INT PRIMARY KEY AUTO_INCREMENT,
    ID_Consumption INT,
    ID_Client INT,
    months INT,
    status_payment BOOLEAN,
    priX_HT DECIMAL(10,2),
    priX_TTC DECIMAL(10,2),
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client),
    FOREIGN KEY (ID_Consumption) REFERENCES Consumption(ID_Consumption)
);

CREATE TABLE Yearly_Consumption (
    ID_Yearly_Consumption INT PRIMARY KEY AUTO_INCREMENT,
    ID_Client INT,
    year INT,
    value float,
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client)
);

CREATE TABLE Reclamation (
    ID_Reclamation INT PRIMARY KEY AUTO_INCREMENT,
    ID_Client INT,
    ID_Facture INT,
    date DATE,
    description TEXT,
    status BOOLEAN,
    FOREIGN KEY (ID_Client) REFERENCES Client(ID_Client),
    FOREIGN KEY (ID_Facture) REFERENCES Facture(ID_Facture)
);

