Use lahman;
DROP TABLE IF EXISTS AllStarFull;
CREATE TABLE AllStarFull (
    playerID VARCHAR(255) COMMENT 'Player ID code',
    yearID INT COMMENT 'Year',
    gameNum INT COMMENT 'Game number (for years in which more than one game was played)',
    gameID VARCHAR(255) COMMENT 'Game ID code',
    teamID VARCHAR(255) COMMENT 'Team; a factor',
    lgID VARCHAR(255) COMMENT 'League; a factor with levels AL NL',
    GP INT COMMENT 'Games played (zero if player did not appear in game)',
    startingPos INT COMMENT 'If the player started, what position he played'
);
DROP TABLE IF EXISTS Batting;
CREATE TABLE Batting (
    playerID VARCHAR(255) COMMENT 'Player ID code',
    yearID INT COMMENT 'Year',
    stint INT COMMENT 'Player’s stint (order of appearances within a season)',
    teamID VARCHAR(255) COMMENT 'Team; a factor',
    lgID VARCHAR(255) COMMENT 'League; a factor with levels AA AL FL NL PL UA',
    G INT COMMENT 'Games: number of games in which a player played',
    AB INT COMMENT 'At Bats',
    R INT COMMENT 'Runs',
    H INT COMMENT 'Hits: times reached base because of a batted, fair ball without error by the defense',
    X2B INT COMMENT 'Doubles: hits on which the batter reached second base safely',
    X3B INT COMMENT 'Triples: hits on which the batter reached third base safely',
    HR INT COMMENT 'Homeruns',
    RBI INT COMMENT 'Runs Batted In',
    SB INT COMMENT 'Stolen Bases',
    CS INT COMMENT 'Caught Stealing',
    BB INT COMMENT 'Base on Balls',
    SO INT COMMENT 'Strikeouts',
    IBB INT COMMENT 'Intentional walks',
    HBP INT COMMENT 'Hit by pitch',
    SH INT COMMENT 'Sacrifice hits',
    SF INT COMMENT 'Sacrifice flies',
    GIDP INT COMMENT 'Grounded into double plays'
);

DROP TABLE IF EXISTS Pitching;
CREATE TABLE Pitching (
    playerID VARCHAR(255) COMMENT 'Player ID code',
    yearID INT COMMENT 'Year',
    stint INT COMMENT 'Player’s stint (order of appearances within a season)',
    teamID VARCHAR(255) COMMENT 'Team; a factor',
    lgID VARCHAR(255) COMMENT 'League; a factor with levels AA AL FL NL PL UA',
    W INT COMMENT 'Wins',
    L INT COMMENT 'Losses',
    G INT COMMENT 'Games',
    GS INT COMMENT 'Games Started',
    CG INT COMMENT 'Complete Games',
    SHO INT COMMENT 'Shutouts',
    SV INT COMMENT 'Saves',
    IPouts INT COMMENT 'Outs Pitched (innings pitched x 3)',
    H INT COMMENT 'Hits',
    ER INT COMMENT 'Earned Runs',
    HR INT COMMENT 'Homeruns',
    BB INT COMMENT 'Walks',
    SO INT COMMENT 'Strikeouts',
    BAOpp FLOAT COMMENT 'Opponent’s Batting Average',
    ERA FLOAT COMMENT 'Earned Run Average',
    IBB INT COMMENT 'Intentional Walks',
    WP INT COMMENT 'Wild Pitches',
    HBP INT COMMENT 'Batters Hit By Pitch',
    BK INT COMMENT 'Balks',
    BFP INT COMMENT 'Batters faced by Pitcher',
    GF INT COMMENT 'Games Finished',
    R INT COMMENT 'Runs Allowed',
    SH INT COMMENT 'Sacrifices by opposing batters',
    SF INT COMMENT 'Sacrifice flies by opposing batters',
    GIDP INT COMMENT 'Grounded into double plays by opposing batter'
);

DROP TABLE IF EXISTS People;
CREATE TABLE People (
    ID INT,
    playerID VARCHAR(255) PRIMARY KEY COMMENT 'A unique code assigned to each player. Links the data with records on players in other files.',
    birthYear INT COMMENT 'Year player was born',
    birthMonth INT COMMENT 'Month player was born',
    birthDay INT COMMENT 'Day player was born',
    birthCity VARCHAR(255) COMMENT 'City where player was born',
    birthCountry VARCHAR(255) COMMENT 'Country where player was born',
    birthState VARCHAR(255) COMMENT 'State where player was born',
    deathYear INT COMMENT 'Year player died',
    deathMonth INT COMMENT 'Month player died',
    deathDay INT COMMENT 'Day player died',
    deathCountry VARCHAR(255) COMMENT 'Country where player died',
    deathState VARCHAR(255) COMMENT 'State where player died',
    deathCity VARCHAR(255) COMMENT 'City where player died',
    nameFirst VARCHAR(255) COMMENT 'Player’s first name',
    nameLast VARCHAR(255) COMMENT 'Player’s last name',
    nameGiven VARCHAR(255) COMMENT 'Player’s given name (typically first and middle)',
    weight INT COMMENT 'Player’s weight in pounds',
    height INT COMMENT 'Player’s height in inches',
    bats VARCHAR(1) COMMENT 'Player’s batting hand (left (L), right (R), or both (B))',
    throws VARCHAR(1) COMMENT 'Player’s throwing hand (left(L) or right(R))',
    debut DATE  COMMENT 'Date that player made first major league appearance',
    bbrefID VARCHAR(255) COMMENT 'ID used by Baseball Reference website, https://www.baseball-reference.com/',
    finalGame DATE COMMENT 'Date that player made first major league appearance (blank if still active)',
    retroID VARCHAR(255) COMMENT 'ID used by retrosheet, https://www.retrosheet.org/'

);

DROP TABLE IF EXISTS Appearances;
CREATE TABLE Appearances (
    yearID INT COMMENT 'Year',
    teamID VARCHAR(255) COMMENT 'Team; a factor',
    lgID VARCHAR(255) COMMENT 'League; a factor with levels AA AL FL NL PL UA',
    playerID VARCHAR(255) COMMENT 'Player ID code',
    G_all INT COMMENT 'Total games played',
    GS INT COMMENT 'Games started',
    G_batting INT COMMENT 'Games in which player batted',
    G_defense INT COMMENT 'Games in which player appeared on defense',
    G_p INT COMMENT 'Games as pitcher',
    G_c INT COMMENT 'Games as catcher',
    G_1b INT COMMENT 'Games as first baseman',
    G_2b INT COMMENT 'Games as second baseman',
    G_3b INT COMMENT 'Games as third baseman',
    G_ss INT COMMENT 'Games as shortstop',
    G_lf INT COMMENT 'Games as left fielder',
    G_cf INT COMMENT 'Games as center fielder',
    G_rf INT COMMENT 'Games as right fielder',
    G_of INT COMMENT 'Games as outfielder',
    G_dh INT COMMENT 'Games as designated hitter',
    G_ph INT COMMENT 'Games as pinch hitter',
    G_pr INT COMMENT 'Games as pinch runner'
);