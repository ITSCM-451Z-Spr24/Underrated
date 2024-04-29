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
            SUM((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB) AS offensiveScore
        FROM 
            People AS p
        JOIN 
            Batting AS b ON p.playerID = b.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID AND b.yearID = a.yearID
        WHERE 
            b.yearID = :year AND a.playerID IS NULL
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
            SUM(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA) AS pitchingScore
        FROM 
            People AS p
        JOIN 
            Pitching AS pt ON p.playerID = pt.playerID
        LEFT JOIN
            AllStarFull AS a ON p.playerID = a.playerID AND pt.yearID = a.yearID
        WHERE 
            pt.yearID = :year AND a.playerID IS NULL
        GROUP BY 
            p.nameFirst, p.nameLast
        ORDER BY 
            pitchingScore DESC
        LIMIT :limit";
}

function getAllStarPitchingSql()
{
    return "
        SELECT 
            AVG(allstar_pitchingScore) AS avg_pitchingScore
        FROM (
            SELECT 
                SUM(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA) AS allstar_pitchingScore
            FROM 
                People AS p
            JOIN 
                Pitching AS pt ON p.playerID = pt.playerID
            JOIN 
                AllStarFull AS a ON p.playerID = a.playerID AND pt.yearID = a.yearID
            WHERE 
                pt.yearID = :year AND a.playerID IS NOT NULL
            GROUP BY 
                p.playerID
			ORDER BY allstar_pitchingScore
			LIMIT :limit
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
                pt.yearID = :year AND a.playerID IS NOT NULL
            GROUP BY 
                p.playerID
			ORDER BY allstar_offensiveScore
        ) AS allstar_scores";
}

?>
