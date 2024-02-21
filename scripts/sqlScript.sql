/* Clinical Sites Table */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE Reservations (
    reservation_ID INT PRIMARY KEY AUTO_INCREMENT,
    payment_Type VARCHAR(300),
    type_Reservation VARCHAR(300)),
    FOREIGN KEY (GuestID) REFERENCES GUEST(GuestID);


INSERT INTO Reservations (`payment_Type`, type_Reservation, )
VALUES ('Massage');


CREATE TABLE MassageReservations (
    payment_ID INT PRIMARY KEY AUTO_INCREMENT,
    date_Reservation DATE,
    time_Reservation TIME,
    type_Massage (Massage_ID) REFERENCES Massage(Massage_ID),
    FOREIGN KEY (reservation_ID) REFERENCES Reservations(GuestID),
    FOREIGN KEY (GuestID) REFERENCES GUEST(GuestID);

DROP TABLE IF EXISTS `Massage`;

CREATE TABLE Massage (
      massage_ID PRIMARY KEY AUTO_INCREMENT,
      type VARCHAR(300),
      price FLOAT(5, 2);


INSERT INTO clinical_sites (`clinical_site_names`)
VALUES ('Harborview');

INSERT INTO clinical_sites (`clinical_site_names`)
VALUES ('Valley Medical');

INSERT INTO clinical_sites (`clinical_site_names`)
VALUES ('Auburn Medical Center');

INSERT INTO clinical_sites (`clinical_site_names`)
VALUES ('UW Medicine');

CREATE TABLE Payments (
    payment_ID INT PRIMARY KEY AUTO_INCREMENT,
    payment_Type VARCHAR(300),
    FOREIGN KEY (reservation_ID) REFERENCES Reservations(GuestID),
    FOREIGN KEY (GuestID) REFERENCES GUEST(GuestID);