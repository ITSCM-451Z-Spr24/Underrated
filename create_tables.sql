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
create table Appearances (
    yearID int,
    teamID varchar(255),
    lgID varchar(255),
    playerID varchar(255),
    G_all int,
    GS int,
    G_batting int,
    G_defense int,
    G_p int,
    G_c int,
    G_1b int,
    G_2b int,
    G_3b int,
    G_ss int,
    G_lf int,
    G_cf int,
    G_rf int,
    G_of int,
    G_dh int,
    G_ph int,
    G_pr int
);
drop table AwardsManagers;
create table AwardsManagers (
    playerID varchar(255),
    awardID varchar(255),
    yearID int,
    lgID varchar(255),
    tie varchar(255),
    notes varchar(255)
);
drop table AwardsPlayers;
create table AwardsPlayers (
    playerID varchar(255),
    awardID varchar(255),
    yearID int,
    lgID varchar(255),
    tie varchar(255),
    notes varchar(255)
);
drop table AwardsShareManagers;
create table AwardsShareManagers (
    awardID varchar(255),
    yearID int,
    lgID varchar(255),
    playerID varchar(255),
    pointsWon int,
    pointsMax int,
    votesFirst int
);
drop table AwardsSharePlayers;
create table AwardsSharePlayers (
    awardID varchar(255),
    yearID int,
    lgID varchar(255),
    playerID varchar(255),
    pointsWon int,
    pointsMax int,
    votesFirst int
);
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
create table BattingPost (
    yearID int,
    round varchar(255),
    playerID varchar(255),
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
drop table Fielding;
create table Fielding (
    playerID varchar(255),
    yearID int,
    stint int,
    teamID varchar(255),
    lgID varchar(255),
    POS varchar(255),
    G int,
    GS int,
    InnOuts int,
    PO int,
    A int,
    E int,
    DP int,
    PB int,
    WP int,
    SB int,
    CS int,
    ZR int
);
drop table FieldingOF;
create table FieldingOF (
    playerID varchar(255),
    yearID int,
    stint int,
    Glf int,
    Gcf int,
    Grf int
);


drop table Fieldingsplits;
create table Fieldingsplits (
    playerID varchar(255),
    yearID int,
    teamID varchar(255),
    lgID varchar(255),
    POS varchar(255),
    G int,
    GS int,
    InnOuts int,
    PO int,
    A int,
    E int,
    DP int,
    PB int,
    WP int,
    SB int,
    CS int,
    ZR int
);
drop table HomeGames;
create table HomeGames (
    yearkey int,
    leaguekey varchar(255),
    teamkey varchar(255),
    parkkey varchar(255),
    span_first varchar(255),
    span_last varchar(255),
    games int,
    openings int,
    attendance int
);
drop table Managers;
create table Managers (
    playerID varchar(255),
    yearID int,
    teamID varchar(255),
    lgID varchar(255),
    inseason int,
    G int,
    W int,
    L int,
    rankd int,
    plyrMgr varchar(255)
);
drop table ManagersHalf ;
create table ManagersHalf (
    playerID varchar(255),
    yearID int,
    teamID varchar(255),
    lgID varchar(255),
    inseason int,
    half varchar(255),
    G int,
    W int,
    L int,
    rankd int
);
DROP TABLE Parks;
CREATE TABLE Parks (
  parkalias VARCHAR(255),
  parkkey VARCHAR(255),
  parkname VARCHAR(255),
  city VARCHAR(255),
  state VARCHAR(255),
  country VARCHAR(255)
);
drop table People;
create table People (
    playerID varchar(255),
    birthYear int,
    birthMonth int,
    birthDay int,
    birthCountry varchar(255),
    birthState varchar(255),
    birthCity varchar(255),
    deathYear int,
    deathMonth int,
    deathDay int,
    deathCountry varchar(255),
    deathState varchar(255),
    deathCity varchar(255),
    nameFirst varchar(255),
    nameLast varchar(255),
    nameGiven varchar(255),
    weight int,
    height int,
    bats varchar(255),
    throws varchar(255),
    debut varchar(255),
    finalGame varchar(255),
    retroID varchar(255),
    bbrefID varchar(255)
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
create table PitchingPost (
    yearID int,
    round varchar(255),
    playerID varchar(255),
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
drop table Salaries;
create table Salaries (
    yearID int,
    teamID varchar(255),
    lgID varchar(255),
    playerID varchar(255),
    salary int
);
drop table Schools;
create table Schools (
    schoolID varchar(255),
    schoolName varchar(255),
    schoolCity varchar(255),
    schoolState varchar(255)
);
drop table SeriesPost;
create table SeriesPost (
    yearID int,
    round varchar(255),
    teamIDwinner varchar(255),
    lgIDwinner varchar(255),
    teamIDloser varchar(255),
    lgIDloser varchar(255),
    wins int,
    losses int,
    ties int
);
drop table Teams;
create table Teams (
    yearID int,
    lgID varchar(255),
    teamID varchar(255),
    franchID varchar(255),
    divID varchar(255),
    Rankd int,
    G int,
    Ghome int,
    W int,
    L int,
    DivWin varchar(255),
    WCWin varchar(255),
    LgWin varchar(255),
    WSWin varchar(255),
    R int,
    AB int,
    H int,
    X2B int,
    X3B int,
    HR int,
    BB int,
    SO int,
    SB int,
    CS int,
    HBP int,
    SF int,
    RA int,
    ER int,
    ERA float,
    CG int,
    SHO int,
    SV int,
    IPouts int,
    HA int,
    HRA int,
    BBA int,
    SOA int,
    E int,
    DP int,
    FP float,
    name varchar(255),
    park varchar(255),
    attendance int,
    BPF int,
    PPF int,
    teamIDBR varchar(255),
    teamIDlahman45 varchar(255),
    teamIDretro varchar(255)
);
drop table TeamsFranchises;
create table TeamsFranchises (
    franchID varchar(255),
    franchName varchar(255),
    active varchar(255)
);
drop table TeamsHalf;
create table TeamsHalf (
    yearID int,
    lgID varchar(255),
    teamID varchar(255),
    Half varchar(255),
    divID varchar(255),
    DivWin varchar(255),
    Rankd int,
    G int,
    W int,
    L int
);

