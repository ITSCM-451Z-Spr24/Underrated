Use lahman;
drop table AllStarFull;
create table AllStarFull (
    playerID varchar(255),
    yearID int,
    gameNum int,
    gameID varchar(255),
    teamID varchar(255),
    lgID varchar(255),
    GP int,
    startingPos int
);
drop table Appearances;
drop table AwardsManagers;
drop table AwardsPlayers;
drop table AwardsShareManagers;
drop table AwardsSharePlayers;
drop table Batting;
create table Batting (
    playerID varchar(255),
    yearID int,
    stint int,
    teamID varchar(255),
    lgID varchar(255),
    G int,
    AB int,
    R int,
    H int,
    X2B int,
    X3B int,
    HR int,
    RBI int,
    SB int,
    CS int,
    BB int,
    SO int,
    IBB int,
    HBP int,
    SH int,
    SF int,
    GIDP int
);
drop table BattingPost;
drop table Fielding;
drop table FieldingOF;
drop table Fieldingsplits;
drop table HomeGames;
drop table Managers;
drop table ManagersHalf ;
DROP TABLE Parks;
drop table People;
create table People (
    playerID varchar(255),
    birthYear int,
    birthMonth int,
    birthDay int,
    birthCity varchar(255),
    birthCountry varchar(255),
    birthState varchar(255),
    nameFirst varchar(255),
    nameLast varchar(255)
);
Drop table Pitching;
create table Pitching (
    playerID varchar(255),
    yearID int,
    stint int,
    teamID varchar(255),
    lgID varchar(255),
    W int,
    L int,
    G int,
    GS int,
    CG int,
    SHO int,
    SV int,
    IPouts int,
    H int,
    ER int,
    HR int,
    BB int,
    SO int,
    BAOpp float,
    ERA float,
    IBB int,
    WP int,
    HBP int,
    BK int,
    BFP int,
    GF int,
    R int,
    SH int,
    SF int,
    GIDP int
);
Drop TABLE PitchingPost;
drop table Salaries;
drop table Schools;
drop table SeriesPost;
drop table Teams;
drop table TeamsFranchises;
drop table TeamsHalf;

