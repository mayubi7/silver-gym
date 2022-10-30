CREATE TABLE StaffRuns(
    AreaOfExpertise CHAR(30),
    Name CHAR(40) NOT NULL,
    IDNumber INTEGER PRIMARY KEY,
    BranchCity CHAR(40) NOT NULL,
    BranchStreetAddress CHAR(60) NOT NULL,
    FOREIGN KEY(BranchCity, BranchStreetAdress),
    REFERENCES Branch(City, StreetAddress) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE PersonalTrainer(
    IDNumber INTEGER PRIMARY KEY,
    FOREIGN KEY(IDNumber),
    REFERENCES StaffRuns(IDNumber) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE ClassInstructor(
    IDNumber INTEGER PRIMARY KEY,
    FOREIGN KEY(IDNumber),
    REFERENCES StaffRuns(IDNumber) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE LocatedIn(
    FacilityID CHAR(10),
    BranchCity CHAR(40),
    BranchStreetAddress(60),
    PRIMARY KEY(FacilityID, BranchCity, BranchStreetAddress),
    FOREIGN KEY(FacilityID) REFERENCES Facility(IDNumber) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(BranchCity, BranchStreetAddress) REFERENCES Branch(City, StreetAddress) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Branch(
    City CHAR(40),
    StreetAddress CHAR(60),
    PRIMARY KEY (City, StreetAddress)
);
CREATE TABLE Enrolled(
    MemberName CHAR(40),
    MemberPhone CHAR(10),
    ClassID INTEGER,
    PRIMARY KEY (MemberName, MemberPhone, ClassID),
    FOREIGN KEY(MemberName, MemberPhone) REFERENCES Member(Name, PhoneNumber) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(ClassID) REFERENCES Class(ID) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE BorrowsRentalEquipment(
    Barcode INTEGER PRIMARY KEY,
    Type CHAR(15) NOT NULL,
    MemberName CHAR(40),
    MemberPhone CHAR(10),
    RentalLimit INTEGER,
    DateBorrowed DATE,
    FOREIGN KEY(MemberName, MemberPhone) REFERENCES Member(Name, PhoneNumber) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (RentalLimit, DateBorrowed) REFERENCES RentalEquipmentDue(RentalLimit, DateBorrowed) ON DELETE
    SET NULL ON UPDATE CASCADE
);
CREATE TABLE RentalEquipmentDue(
    RentalLimit INTEGER,
    DateBorrowed DATE,
    DueDate DATE NOT NULL,
    PRIMARY KEY (RentalLimit, DateBorrowed)
);
CREATE TABLE Facility(
    ID CHAR(10) PRIMARY KEY,
    Size CHAR(10),
    FOREIGN KEY (Size) REFERENCES FacilitySize(Size) ON DELETE
    SET DEFAULT ON UPDATE CASCADE
);
CREATE TABLE FacilitySize(
    Size CHAR(10) PRIMARY KEY,
    Capacity INTEGER NOT NULL
);
CREATE TABLE Teach(
    ClassID INTEGER,
    ClassInstructorID INTEGER,
    ClassTime CHAR(11),
    PRIMARY KEY (ClassID, ClassInstructorID),
    FOREIGN KEY (ClassID) REFERENCES Class(ID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ClassInstructorID) REFERENCES ClassInstructor(IDNumber) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Member(
    Name CHAR(40),
    PhoneNumber CHAR(10),
    EmergencyContact CHAR(10) NOT NULL,
    EndDate DATE NOT NULL,
    MembershipTier CHAR(15) NOT NULL,
    PersonalTrainerID INTEGER,
    PRIMARY KEY(Name, PhoneNumber),
    FOREIGN KEY (MembershipTier) REFERENCES Membership(Tier) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (PersonalTrainerID) REFERENCES PersonalTrainer(IDNumber) ON DELETE
    SET NULL ON UPDATE CASCADE
);
CREATE TABLE Membership(
    Tier CHAR(15),
    Price CHAR(10) NOT NULL,
    PRIMARY KEY (Tier)
);
CREATE TABLE PersonalBest(
    MemberName CHAR(40),
    MemberPhoneCHAR(10),
    Date DATE,
    LiftType CHAR(15),
    Weight INTEGER NOT NULL,
    PRIMARY KEY (MemberName, MemberPhone, LiftType),
    FOREIGN KEY (MemberName, MemberPhone) REFERENCES Member(Name, PhoneNumber) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Accesses(
    MembershipTier CHAR(15),
    FacilityID CHAR(10),
    PRIMARY KEY (MembershipTier, FacilityID),
    FOREIGN KEY (MembershipTier) REFERENCES Membership(Tier) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (FacilityID) REFERENCES Facility (ID) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Class (
    ID INTEGER PRIMARY KEY,
    Title CHAR(40) NOT NULL,
    FacilityID CHAR(10),
    FOREIGN KEY (FacilityID) REFERENCES Facility (ID) ON DELETE CASCADE ON UPDATE CASCADE
);