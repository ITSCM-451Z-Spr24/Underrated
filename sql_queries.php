<?php

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
            SUM(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA) AS pitchingScore
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
?>
