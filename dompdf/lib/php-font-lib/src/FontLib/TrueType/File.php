<?php
/**
 * @package php-font-lib
 * @link    https://github.com/PhenX/php-font-lib
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace FontLib\TrueType;

use FontLib\AdobeFontMetrics;
use FontLib\Font;
use FontLib\BinaryStream;
use FontLib\Table\Table;
use FontLib\Table\DirectoryEntry;
use FontLib\Table\Type\glyf;
use FontLib\Table\Type\name;
use FontLib\Table\Type\nameRecord;

/**
 * TrueType font file.
 *
 * @package php-font-lib
 */
class File extends BinaryStream {
  /**
   * @var Header
   */
  public $header = array();

  private $tableOffset = 0; // Used for TTC

  private static $raw = false;

  protected $directory = array();
  protected $data = array();

  protected $glyph_subset = array();

  public $glyph_all = array();

  static $macCharNames = array(
    ".notdef", ".null", "CR",
    "space", "exclam", "quotedbl", "numbersign",
    "dollar", "percent", "ampersand", "quotesingle",
    "parenleft", "parenright", "asterisk", "plus",
    "comma", "hyphen", "period", "slash",
    "zero", "one", "two", "three",
    "four", "five", "six", "seven",
    "eight", "nine", "colon", "semicolon",
    "less", "equal", "greater", "question",
    "at", "A", "B", "C", "D", "E", "F", "G",
    "H", "I", "J", "K", "L", "M", "N", "O",
    "P", "Q", "R", "S", "T", "U", "V", "W",
    "X", "Y", "Z", "bracketleft",
    "backslash", "bracketright", "asciicircum", "underscore",
    "grave", "a", "b", "c", "d", "e", "f", "g",
    "h", "i", "j", "k", "l", "m", "n", "o",
    "p", "q", "r", "s", "t", "u", "v", "w",
    "x", "y", "z", "braceleft",
    "bar", "braceright", "asciitilde", "Adieresis",
    "Aring", "Ccedilla", "Eacute", "Ntilde",
    "Odieresis", "Udieresis", "aacute", "agrave",
    "acircumflex", "adieresis", "atilde", "aring",
    "ccedilla", "eacute", "egrave", "ecircumflex",
    "edieresis", "iacute", "igrave", "icircumflex",
    "idieresis", "ntilde", "oacute", "ograve",
    "ocircumflex", "odieresis", "otilde", "uacute",
    "ugrave", "ucircumflex", "udieresis", "dagger",
    "degree", "cent", "sterling", "section",
    "bullet", "paragraph", "germandbls", "registered",
    "copyright", "trademark", "acute", "dieresis",
    "notequal", "AE", "Oslash", "infinity",
    "plusminus", "lessequal", "greaterequal", "yen",
    "mu", "partialdiff", "summation", "product",
    "pi", "integral", "ordfeminine", "ordmasculine",
    "Omega", "ae", "oslash", "questiondown",
    "exclamdown", "logicalnot", "radical", "florin",
    "approxequal", "increment", "guillemotleft", "guillemotright",
    "ellipsis", "nbspace", "Agrave", "Atilde",
    "Otilde", "OE", "oe", "endash",
    "emdash", "quotedblleft", "quotedblright", "quoteleft",
    "quoteright", "divide", "lozenge", "ydieresis",
    "Ydieresis", "fraction", "currency", "guilsinglleft",
    "guilsinglright", "fi", "fl", "daggerdbl",
    "periodcentered", "quotesinglbase", "quotedblbase", "perthousand",
    "Acircumflex", "Ecircumflex", "Aacute", "Edieresis",
    "Egrave", "Iacute", "Icircumflex", "Idieresis",
    "Igrave", "Oacute", "Ocircumflex", "applelogo",
    "Ograve", "Uacute", "Ucircumflex", "Ugrave",
    "dotlessi", "circumflex", "tilde", "macron",
    "breve", "dotaccent", "ring", "cedilla",
    "hungarumlaut", "ogonek", "caron", "Lslash",
    "lslash", "Scaron", "scaron", "Zcaron",
    "zcaron", "brokenbar", "Eth", "eth",
    "Yacute", "yacute", "Thorn", "thorn",
    "minus", "multiply", "onesuperior", "twosuperior",
    "threesuperior", "onehalf", "onequarter", "threequarters",
    "franc", "Gbreve", "gbreve", "Idot",
    "Scedilla", "scedilla", "Cacute", "cacute",
    "Ccaron", "ccaron", "dmacron"
  );

  function getTable() {
    $this->parseTableEntries();

    return $this->directory;
  }

  function setTableOffset($offset) {
    $this->tableOffset = $offset;
  }

  function parse() {
    $this->parseTableEntries();

    $this->data = array();

    foreach ($this->directory as $tag => $table) {
      if (empty($this->data[$tag])) {
        $this->readTable($tag);
      }
    }
  }

  function utf8toUnicode($str) {
    $len = strlen($str);
    $out = array();

    for ($i = 0; $i < $len; $i++) {
      $uni = -1;
      $h   = ord($str[$i]);

      if ($h <= 0x7F) {
        $uni = $h;
      }
      elseif ($h >= 0xC2) {
        if (($h <= 0xDF) && ($i < $len - 1)) {
          $uni = ($h & 0x1F) << 6 | (ord($str[++$i]) & 0x3F);
        }
        elseif (($h <= 0xEF) && ($i < $len - 2)) {
          $uni = ($h & 0x0F) << 12 | (ord($str[++$i]) & 0x3F) << 6 | (ord($str[++$i]) & 0x3F);
        }
        elseif (($h <= 0xF4) && ($i < $len - 3)) {
          $uni = ($h & 0x0F) << 18 | (ord($str[++$i]) & 0x3F) << 12 | (ord($str[++$i]) & 0x3F) << 6 | (ord($str[++$i]) & 0x3F);
        }
      }

      if ($uni >= 0) {
        $out[] = $uni;
      }
    }

    return $out;
  }

  function getUnicodeCharMap() {
    $subtable = null;
    foreach ($this->getData("cmap", "subtables") as $_subtable) {
      if ($_subtable["platformID"] == 0 || $_subtable["platformID"] == 3 && $_subtable["platformSpecificID"] == 1) {
        $subtable = $_subtable;
        break;
      }
    }

    if ($subtable) {
      return $subtable["glyphIndexArray"];
    }

    return null;
  }

  function setSubset($subset) {
    if (!is_array($subset)) {
      $subset = $this->utf8toUnicode($subset);
    }

    $subset = array_unique($subset);

    $glyphIndexArray = $this->getUnicodeCharMap();

    if (!$glyphIndexArray) {
      return;
    }

    $gids = array(
      0, // .notdef
      1, // .null
    );

    foreach ($subset as $code) {
      if (!isset($glyphIndexArray[$code])) {
        continue;
      }

      $gid        = $glyphIndexArray[$code];
      $gids[$gid] = $gid;
    }

    /** @var glyf $glyf */
    $