<?php

namespace xfit\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * xfit\AdminBundle\Entity\Workout
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Workout
{
  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string $name
   *
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @var text $ante
   *
   * @ORM\Column(name="ante", type="text", nullable="true")
   */
  private $ante;

  /**
   * @var text $buy_in
   *
   * @ORM\Column(name="buy_in", type="text", nullable="true")
   */
  private $buy_in;

  /**
   * @var text $cash_out
   *
   * @ORM\Column(name="cash_out", type="text", nullable="true")
   */
  private $cash_out;

  /**
   * @var date $workout_date
   *
   * @ORM\Column(name="workout_date", type="date")
   */
  private $workout_date;


  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set ante
   *
   * @param text $ante
   */
  public function setAnte($ante)
  {
    $this->ante = $ante;
  }

  /**
   * Get ante
   *
   * @return text
   */
  public function getAnte()
  {
    return $this->ante;
  }

  /**
   * Set buy_in
   *
   * @param text $buyIn
   */
  public function setBuyIn($buyIn)
  {
    $this->buy_in = $buyIn;
  }

  /**
   * Get buy_in
   *
   * @return text
   */
  public function getBuyIn()
  {
    return $this->buy_in;
  }

  /**
   * Set cash_out
   *
   * @param text $cashOut
   */
  public function setCashOut($cashOut)
  {
    $this->cash_out = $cashOut;
  }

  /**
   * Get cash_out
   *
   * @return text
   */
  public function getCashOut()
  {
    return $this->cash_out;
  }

  /**
   * Get cash_out
   *
   * @return text
   */
  public function getWorkoutDate()
  {
    return $this->workout_date;
  }

  /**
   * Set cash_out
   *
   * @param text $cashOut
   */
  public function setWorkoutDate($workout_date)
  {
    $this->workout_date = $workout_date;
  }
}
