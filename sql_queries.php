<?php

// SQL query to fetch distinct years
function getYearsSql()
{
    return "SELECT DISTINCT yearID FROM AllStarFull ORDER BY yearID DESC";
}
function getOffensiveSql()
{
    return "
        SELECT 
            p.nameFirst,
            p.nameLast,
            ROUND(AVG((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB), 2) AS offensiveScore
        FROM 
            People AS p
        JOIN 
            Batting AS b ON p.playerID = b.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID
        WHERE 
            b.yearID = :year 
            AND a.playerID IS NULL 
            AND p.playerID NOT IN (SELECT playerID FROM AllStarFull)
            AND offensiveScore > 0 -- Exclude negative scores or blanks
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            offensiveScore DESC
        LIMIT :limit";
}

function getPitchingSql()
{
    return "
        SELECT 
            p.nameFirst,
            p.nameLast,
            ROUND(AVG(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA),2) AS pitchingScore
        FROM 
            People AS p
        JOIN 
            Pitching AS pt ON p.playerID = pt.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID
        WHERE 
            pt.yearID = :year 
            AND a.playerID IS NULL 
            AND p.playerID NOT IN (SELECT playerID FROM AllStarFull)
            AND pitchingScore > 0 -- Exclude negative scores or blanks
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            pitchingScore DESC
        LIMIT :limit";
}

function getAllStarOffensiveSql()
{
    return "
        SELECT 
            p.nameFirst,
            p.nameLast,
            ROUND(AVG((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB), 2) AS allstar_offensiveScore
        FROM 
            People AS p
        JOIN 
            Batting AS b ON p.playerID = b.playerID
        JOIN 
            AllStarFull AS a ON p.playerID = a.playerID AND b.yearID = a.yearID
        WHERE 
            b.yearID = :year
            AND allstar_offensiveScore > 0 -- Exclude negative scores or blanks
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            allstar_offensiveScore DESC
        LIMIT :limit";
}

function getAllStarPitchingSql()
{
    return "
        SELECT 
            p.nameFirst,
            p.nameLast,
            ROUND(AVG(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA),2) AS allstar_pitchingScore
        FROM 
            People AS p
        JOIN 
            Pitching AS pt ON p.playerID = pt.playerID
        JOIN 
            AllStarFull AS a ON p.playerID = a.playerID AND pt.yearID = a.yearID
        WHERE 
            pt.yearID = :year
            AND allstar_pitchingScore > 0 -- Exclude negative scores or blanks
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            allstar_pitchingScore DESC
        LIMIT :limit";
}
