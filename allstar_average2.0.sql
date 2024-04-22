SELECT
    AVG(allstar_offensiveScore) AS avg_offensiveScore,
    AVG(allstar_pitchingScore) AS avg_pitchingScore
FROM (
    SELECT
        SUM((((b.H - b.HR) / (b.AB - b.R - b.HR + b.SF)) + (b.H + b.X2B + (2 * b.X3B) + (3 * b.HR)) / b.AB) + b.SB) AS allstar_offensiveScore,
        SUM(pt.W + (pt.IPouts / 3) + pt.SV - pt.ERA) AS allstar_pitchingScore
    FROM
        People AS p
    INNER JOIN
        Batting AS b ON p.player_id = b.player_id
    INNER JOIN
        Pitching AS pt ON p.player_id = pt.player_id
    INNER JOIN
        AllStarFull AS af ON p.player_id = af.PlayerID
    WHERE
        af.PlayerID IS NOT NULL
    GROUP BY
        p.player_id
) AS allstar_scores;
