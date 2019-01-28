<?php
/**
 * @package php-font-lib
 * @link    https://github.com/PhenX/php-font-lib
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @version $Id: Font_Table_glyf.php 46 2012-04-02 20:22:38Z fabien.menager $
 */

namespace FontLib\Glyph;

/**
 * `glyf` font table.
 *
 * @package php-font-lib
 */
class OutlineSimple extends Outline {
  const ON_CURVE       = 0x01;
  const X_SHORT_VECTOR = 0x02;
  const Y_SHORT_VECTOR = 0x04;
  const REPEAT         = 0x08;
  const THIS_X_IS_SAME = 0x10;
  const THIS_Y_IS_SAME = 0x20;

  public $instructions;
  public $points;

  function parseData() {
    parent::parseData();

    if (!$this->size) {
      return;
    }

    $font = $this->getFont();

    $noc = $this->numberOfContours;

    if ($noc == 0) {
      return;
    }

    $endPtsOfContours = $font->r(array(self::uint16, $noc));

    $instructionLength  = $font->readUInt16();
    $this->instructions = $font->r(array(self::uint8, $instructionLength));

    $count = $endPtsOfContours[$noc - 1] + 1;

    // Flags
    $flags = array();
    for ($index = 0; $index < $count; $index++) {
      $flags[$index] = $font->readUInt8();

      if ($flags[$index] & self::REPEAT) {
        $repeats = $font->readUInt8();

        for ($i = 1; $i <= $repeats; $i++) {
          $flags[$index + $i] = $flags[$index];
        }

        $index += $repeats;
      }
    }

 