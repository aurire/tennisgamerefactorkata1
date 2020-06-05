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
    const WINNER_NONE_OR_DRAW = 0;

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
        if ($this->player1Name === $playerName) {
            $this->playerScore1++;
        } else {
            $this->playerScore2++;
        }
    }

    /**
     * @param int $playerNumber
     * @return string
     */
    public function getPlayerName(int $playerNumber): string
    {
        return 1 === $playerNumber ? $this->player1Name : $this->player2Name;
    }

    /**
     * @return int
     */
    public function getWinnerPlayerNumber(): int
    {
        return $this->playerScore1 === $this->playerScore2 ? 0 : ($this->playerScore1 > $this->playerScore2 ? 1 : 2);
    }

    /**
     * @return int
     */
    public function getMaxScore(): int
    {
        return $this->playerScore1 > $this->playerScore2 ? $this->playerScore1 : $this->playerScore2;
    }

    /**
     * @param int $currentMax
     * @return string
     */
    public function getScoreOnDrawByCurrentMaxScore(int $currentMax): string
    {
        if (3 === $currentMax) {
            return self::SCORE_DEUCE;
        }

        return static::SCORE_NAMES[$currentMax] . '-All';

    }

    /**
     * @param int $winnerNumber
     * @return string
     */
    public function getScoreInAdvantageDeuceOrWinStageByWinnerNumber(int $winnerNumber): string
    {
        $difference = $this->playerScore1 - $this->playerScore2;
        if (1 === $difference || -1 === $difference) {
            return 'Advantage ' . $this->getPlayerName($winnerNumber);
        }

        return 'Win for ' . $this->getPlayerName($winnerNumber);
    }

    /**
     * @return string
     */
    public function getScore()
    {
        $max = $this->getMaxScore();
        $winnerNumber = $this->getWinnerPlayerNumber();
        if ($max < 4) {
            return static::WINNER_NONE_OR_DRAW === $winnerNumber
                ? $this->getScoreOnDrawByCurrentMaxScore($max)
                : static::SCORE_NAMES[$this->playerScore1] . '-' . static::SCORE_NAMES[$this->playerScore2];
        }
        if (static::WINNER_NONE_OR_DRAW === $winnerNumber) {
            return self::SCORE_DEUCE;
        }

        return $this->getScoreInAdvantageDeuceOrWinStageByWinnerNumber($winnerNumber);
    }
}
