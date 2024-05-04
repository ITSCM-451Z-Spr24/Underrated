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
            b.yearID = :year AND a.playerID IS NULL AND p.playerID NOT IN (SELECT playerID FROM AllStarFull)
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
            pt.yearID = :year AND a.playerID IS NULL AND p.playerID NOT IN (SELECT playerID FROM AllStarFull)
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            pitchingScore DESC
        LIMIT :limit";
}

// SQL query to fetch the overall average pitching score for All-Star players for a specific year
function getAllStarPitchingSql()
{
    return "
        SELECT 
            AVG(allstar_pitchingScore) AS overall_avg_pitchingScore
        FROM (
            SELECT 
                AVG(b.W + (b.IPouts / 3) + b.SV - b.ERA) AS allstar_pitchingScore
            FROM 
                People AS p
            JOIN 
                AllStarFull AS a ON p.playerID = a.playerID AND a.yearID = :year
            LEFT JOIN
                Pitching AS b ON p.playerID = b.playerID
            WHERE 
                a.yearID = :year
            GROUP BY 
                p.playerID
        ) AS allstar_scores";
}

function getAllStarOffensiveSql()
{
    return "
        SELECT 
            AVG(allstar_offensiveScore) AS avg_offensiveScore
        FROM (
            SELECT 
                SUM((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB) AS allstar_offensiveScore
            FROM 
                People AS p
            JOIN 
                Batting AS b ON p.playerID = b.playerID
            JOIN 
                AllStarFull AS a ON p.playerID = a.playerID AND b.yearID = a.yearID
            WHERE 
                b.yearID = :year AND (a.playerID IS NOT NULL OR b.yearID >= :year - 5)
            GROUP BY 
                p.playerID
            ORDER BY allstar_offensiveScore
            LIMIT :limit
        ) AS allstar_scores";
}
