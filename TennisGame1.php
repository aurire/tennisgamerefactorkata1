<?php

/**
 * Class TennisGame1
 */
class TennisGame1 implements TennisGame
{
    const SCORE_NAMES = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty',
    ];
    const SCORE_DEUCE = 'Deuce';
    const ID_PLAYER_1 = 'player1';

    private $playerScore1 = 0;
    private $playerScore2 = 0;
    private $player1Name = '';
    private $player2Name = '';

    /**
     * TennisGame1 constructor.
     * @param string $player1Name
     * @param string $player2Name
     */
    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    /**
     * @param string $playerName
     */
    public function wonPoint($playerName)
    {
        if (self::ID_PLAYER_1 == $playerName) {
            $this->playerScore1++;
        } else {
            $this->playerScore2++;
        }
    }

    /**
     * @return string
     */
    public function getScore()
    {
        $max = $this->playerScore1 > $this->playerScore2 ? $this->playerScore1 : $this->playerScore2;
        $wins = $this->playerScore1 === $this->playerScore2 ? 0 : ($this->playerScore1 > $this->playerScore2 ? 1 : 2);
        if ($max < 4) {
            if (0 === $wins) {
                if (3 === $max) {
                    return self::SCORE_DEUCE;
                } else {
                    return static::SCORE_NAMES[$max] . '-All';
                }
            } else {
                return static::SCORE_NAMES[$this->playerScore1] . '-' . static::SCORE_NAMES[$this->playerScore2];
            }
        }
        if (0 === $wins) {
            return self::SCORE_DEUCE;
        }
        $difference = abs($this->playerScore1 - $this->playerScore2);
        if ($difference > 1) {
            return 'Win for player' . $wins;
        }

        return 'Advantage player' . $wins;
    }
}
