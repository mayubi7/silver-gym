INSERT INTO StaffRuns
VALUES(
        “ Yoga ”,
        “ Andy Smythe ”,
        “ 193756 ”,
        “ Burnaby ”,
        “ 1673 Macdonald St.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Kickboxing ”,
        “ Sam Proud ”,
        “ 739038 ”,
        “ Vancouver ”,
        “ 13 Main St.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Reception ”,
        “ Sasha Williams ”,
        ” 178033 ”,
        “ Coquitlam ”,
        “ 4474 Maple Ave.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Kickboxing ”,
        “ Michelle Quaker ”,
        ” 777977 ”,
        “ Vancouver ”,
        “ 13 Main St.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Olympic Weightlifting ”,
        “ Charlie Poth ”,
        “ 872536 ”,
        “ Vancouver ”,
        “ 994 Marine Dr.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Bodybuilding ”,
        “ Arnold Schwartz ”,
        “ 125367 ”,
        “ Toronto ”,
        “ 924 Joust St.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Pilates ”,
        “ Jordan Polo ”,
        “ 045732 ”,
        “ Toronto ”,
        “ 924 Joust St.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Bodybuilding ”,
        “ Kiana Keith ”,
        “ 019253 ”,
        “ Vancouver ”,
        “ 994 Marine Dr.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Water Aerobics ”,
        “ Vanna Blanche ”,
        “ 555678 ”,
        “ Coquitlam ”,
        “ 4474 Maple Ave.”
    );
INSERT INTO StaffRuns
VALUES(
        “ Yoga ”,
        “ Frank Rivers ”,
        “ 006370 ”,
        “ Vancouver ”,
        “ 13 Main St.”
    );
INSERT INTO Personal Trainer
VALUES(“ 872536 ”);
INSERT INTO Personal Trainer
VALUES(“ 739038 ”);
INSERT INTO Personal Trainer
VALUES(“ 125367 ”);
INSERT INTO Personal Trainer
VALUES(“ 045732 ”);
INSERT INTO Personal Trainer
VALUES(“ 006370 ”);
INSERT INTO Class Instructor
VALUES(“ 193756 ”);
INSERT INTO Class Instructor
VALUES(“ 739038 ”);
INSERT INTO Class Instructor
VALUES(“ 777977 ”);
INSERT INTO Class Instructor
VALUES(“ 019253 ”);
INSERT INTO Class Instructor
VALUES(“ 555678 ”);
INSERT INTO LocatedIn
VALUES(“ YOGSTD ”, “ Burnaby ”, “ 1673 Macdonald St.”);
INSERT INTO LocatedIn
VALUES(“ POOL ”, “ Coquitlam ”, “ 4474 Maple Ave.”);
INSERT INTO LocatedIn
VALUES(“ BOXRNG ”, “ Vancouver ”, “ 13 Main St.”);
INSERT INTO LocatedIn
VALUES(“ GYM ”, “ Vancouver ”, “ 994 Marine Dr.”);
INSERT INTO LocatedIn
VALUES(“ BOXRNG ”, “ Toronto ”, “ 924 Joust St.”);
INSERT INTO Branch
VALUES(“ Burnaby ”, “ 1673 Macdonald St.”);
INSERT INTO Branch
VALUES(“ Coquitlam ”, “ 4474 Maple Ave.”);
INSERT INTO Branch
VALUES(“ Vancouver ”, “ 13 Main St.”);
INSERT INTO Branch
VALUES(“ Vancouver ”, “ 994 Marine Dr.”);
INSERT INTO Branch
VALUES(“ Toronto ”, “ 924 Joust St.”);
INSERT INTO Member
VALUES(
        “ Terminator ”,
        “ + 1234555 ”,
        “ + 9000955 ”,
        “ Gold ”,
        “ 872536 ”,
        “ 2022 -12 -12 ”
    );
INSERT INTO Member
VALUES(
        “ Bucky ”,
        “ + 12355 ”,
        “ + 000000 ”,
        “ Bronze ”,
        “ 739038 ”,
        “ 2022 -12 -12
    );
INSERT INTO Member
VALUES(
        “ Captain Canada ”,
        “ + 2352 ”,
        “ + 5551555 ”,
        “ Silver ”,
        “ 125367 ”,
        “ 2022 -12 -12
    );
INSERT INTO Member
VALUES(
        “ Iron Dog ”,
        “ + 54252424 ”,
        “ + 655555 ”,
        “ Platinum ”,
        “ 045732 ”,
        “ 2022 -12 -12
    );
INSERT INTO Member
VALUES(
        “ Guy Fiery ”,
        “ + 5152424 ”,
        “ + 6969696 ”,
        “ Basic ”,
        “ 006370 ”,
        “ 2022 -12 -12
    );
INSERT INTO Membership
VALUES(“ Gold ”, “ 129.99 ”);
INSERT INTO Membership
VALUES(“ Bronze ”, “ 59.99 ”);
INSERT INTO Membership
VALUES(“ Silver ”, “ 79.99 ”);
INSERT INTO Membership
VALUES(“ Platinum ”, “ 200 ”);
INSERT INTO Membership
VALUES(“ Basic ”, “ 39.99 ”);
INSERT INTO PersonalBest
VALUES(
        “ Terminator ”,
        “ + 1234555 ”,
        “ 2022 -12 -12 ”,
        “ Bench Press ”,
        405
    );
INSERT INTO PersonalBest
VALUES(“ Bucky ”, “ + 12355 ”, “ 2022 -02 -12 ”, “ Squat ”, 405);
INSERT INTO PersonalBest
VALUES(
        “ Captain Canada ”,
        “ + 2352 ”,
        “ 2021 -12 -12 ”,
        “ Dead Lift ”,
        455
    );
INSERT INTO PersonalBest
VALUES(
        “ Iron Dog ”,
        “ + 54252424 ”,
        “ 2020 -12 -12 ”,
        “ Bench Press ”,
        420
    );
INSERT INTO PersonalBest
VALUES(
        “ Guy Fiery ”,
        “ + 5152424 ”,
        “ 2022 -12 -10 ”,
        “ Front Squat ”,
        205
    );
INSERT INTO Accesses
VALUES(“ Gold ”, “ YOGSTD ”);
INSERT INTO Accesses
VALUES(“ Silver ”, “ POOL ”);
INSERT INTO Accesses
VALUES(“ Platinum ”, “ BOXRNG ”);
INSERT INTO Accesses
VALUES(“ Bronze ”, “ GYM ”);
INSERT INTO Accesses
VALUES(“ Basic ”, “ GYM ”);
INSERT INTO Class
VALUES(1, “ Yoga for Seniors ”, “ YOGSTD ”);
INSERT INTO Class
VALUES(2, “ Kickboxing for Beginners ”, “ BOXRNG ”);
INSERT INTO Class
VALUES(3, “ Mua Thai ”, “ BOXRNG ”);
INSERT INTO Class
VALUES(4, “ Body Building II ”, “ GYM ”);
INSERT INTO Class
VALUES(5, “ Water Aerobics I ”, “ POOL ”);
INSERT INTO Enrolled
VALUES(“ Terminator ”, “ + 1234555 ”, 1);
INSERT INTO Enrolled
VALUES(“ Terminator ”, “ + 1234555 ”, 5);
INSERT INTO Enrolled
VALUES(“ Bucky ”, “ + 12355 ”, 2);
INSERT INTO Enrolled
VALUES(“ Captain Canada ”, “ + 2352 ”, 4);
INSERT INTO Enrolled
VALUES(“ Iron Dog ”, “ + 54252424 ”, 5);
INSERT INTO BorrowsRentalEquipment
VALUES(
        11111,
        “ 30lbs dumbbells ”,
        “ Iron Dog ”,
        “ + 54252424 ”,
        5,
        “ 2022 -09 -12 ”
    );
INSERT INTO BorrowsRentalEquipment
VALUES(
        11112,
        “ jump rope ”,
        “ Terminator ”,
        “ + 1234555 ”,
        14,
        “ 2022 -10 -15 ”
    );
INSERT INTO BorrowsRentalEquipment
VALUES(
        11113,
        “ boxing gloves ”,
        “ Bucky ”,
        “ + 12355 ”,
        5,
        “ 2022 -10 -15 ”
    );
INSERT INTO BorrowsRentalEquipment
VALUES(
        11114,
        “ yoga mat ”,
        “ Captain Canada ”,
        “ + 2352 ”,
        7,
        “ 2022 -10 -15 ”
    );
INSERT INTO BorrowsRentalEquipment
VALUES(
        11115,
        “ boxing gloves ”,
        “ Guy Fiery ”,
        “ + 5152424 ”,
        5,
        “ 2022 -09 -03 ”
    );
INSERT INTO RentalEquipmentDue
VALUES(5, “ 2022 -09 -12 ”, “ 2022 -09 -17 ”);
INSERT INTO RentalEquipmentDue
VALUES(14, “ 2022 -10 -15 ”, “ 2022 -10 -29 ”);
INSERT INTO RentalEquipmentDue
VALUES(5, “ 2022 -10 -15 ”, “ 2022 -10 -20 ”);
INSERT INTO RentalEquipmentDue
VALUES(7, “ 2022 -09 -03 ”, “ 2022 -09 -10 ”);
INSERT INTO RentalEquipmentDue
VALUES(5, “ 2022 -09 -13 ”, “ 2022 -09 -18 ”);
INSERT INTO Facility
VALUES(“ POOL ”, “ mid - large ”);
INSERT INTO Facility
VALUES(“ YOGSTD ”, “ small ”);
INSERT INTO Facility
VALUES(“ BOXRNG ”, “ medium ”);
INSERT INTO Facility
VALUES(“ GYM ”, “ large ”);
INSERT INTO Facility
VALUES(“ RUNTRK ”, “ small - mid ”);
INSERT INTO FacilitySize
VALUES(“ small ”, 20);
INSERT INTO FacilitySize
VALUES(“ medium ”, 100);
INSERT INTO FacilitySize
VALUES(“ large ”, 300);
INSERT INTO FacilitySize
VALUES(“ mid - large ”, 200);
INSERT INTO FacilitySize
VALUES(“ small - mid ”, 50);
INSERT INTO TEACH
VALUES(1, “ 193756 ”, “ 2 :30 -3 :30 ”);
INSERT INTO TEACH
VALUES(2, “ 739038 ”, “ 11 :00 -12 :30 ”);
INSERT INTO TEACH
VALUES(2, “ 777977 ”, “ 11 :00 -12 :30 ”);
INSERT INTO TEACH
VALUES(3, “ 777977 ”, “ 9 :00 -10 :00 ”);
INSERT INTO TEACH
VALUES(4, “ 019253 ”, “ 9 :00 -10 :00 ”);
INSERT INTO TEACH
VALUES(5, “ 555678 ”, “ 14 :00 -16 :00 ”);