<?php

/*
 * This file is part of Geokit.
 *
 * (c) Jan Sorgalla <jsorgalla@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geokit\Geometry\Transformer;

use Geokit\Geometry\GeometryCollection;
use Geokit\Geometry\LineString;
use Geokit\Geometry\LinearRing;
use Geokit\Geometry\MultiLineString;
use Geokit\Geometry\MultiPoint;
use Geokit\Geometry\MultiPolygon;
use Geokit\Geometry\Point;
use Geokit\Geometry\Polygon;

/**
 * @author  Jan Sorgalla <jsorgalla@googlemail.com>
 * @version @package_version@
 */
abstract class AbstractWKBTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function wkbDataProvider()
    {
        $data = array();

        $data[] = array(
            '0101000000000000000000f03f000000000000f03f',
            new Point(1, 1),
            "%s correctly processes Point"
        );

        $data[] = array(
            '0104000000020000000101000000000000000000f03f0000000000000040010100000000000000000008400000000000001040',
            new MultiPoint(
                array(
                    new Point(1, 2),
                    new Point(3, 4)
                )
            ),
            "%s correctly processes MultiPoint"
        );

        $data[] = array(
            '010200000002000000000000000000f03f000000000000004000000000000008400000000000001040',
            new LineString(
                array(
                    new Point(1, 2),
                    new Point(3, 4)
                )
            ),
            "%s correctly processes LineString"
        );

        $data[] = array(
            '010500000002000000010200000002000000000000000000f03f000000000000004000000000000008400000000000001040010200000002000000000000000000144000000000000018400000000000001c400000000000002040',
            new MultiLineString(
                array(
                    new LineString(
                        array(
                            new Point(1, 2),
                            new Point(3, 4)
                        )
                    ),
                    new LineString(
                        array(
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    )
                )
            ),
            "%s correctly processes MultiLineString"
        );

        $data[] = array(
            '01030000000200000005000000000000000000f03f000000000000004000000000000008400000000000001040000000000000144000000000000018400000000000001c400000000000002040000000000000f03f00000000000000400500000000000000000022400000000000002440000000000000264000000000000028400000000000002a400000000000002c400000000000002e40000000000000304000000000000022400000000000002440',
            new Polygon(
                array(
                    new LinearRing(
                        array(
                            new Point(1, 2),
                            new Point(3, 4),
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    ),
                    new LinearRing(
                        array(
                            new Point(9, 10),
                            new Point(11, 12),
                            new Point(13, 14),
                            new Point(15, 16)
                        )
                    )
                )
            ),
            "%s correctly processes Polygon"
        );

        $data[] = array(
            '01060000000200000001030000000200000005000000000000000000f03f000000000000004000000000000008400000000000001040000000000000144000000000000018400000000000001c400000000000002040000000000000f03f00000000000000400500000000000000000022400000000000002440000000000000264000000000000028400000000000002a400000000000002c400000000000002e400000000000003040000000000000224000000000000024400103000000020000000500000000000000000031400000000000003240000000000000334000000000000034400000000000003540000000000000364000000000000037400000000000003840000000000000314000000000000032400500000000000000000039400000000000003a400000000000003b400000000000003c400000000000003d400000000000003e400000000000003f40000000000000404000000000000039400000000000003a40',
            new MultiPolygon(
                array(
                    new Polygon(
                        array(
                            new LinearRing(
                                array(
                                    new Point(1, 2),
                                    new Point(3, 4),
                                    new Point(5, 6),
                                    new Point(7, 8)
                                )
                            ),
                            new LinearRing(
                                array(
                                    new Point(9, 10),
                                    new Point(11, 12),
                                    new Point(13, 14),
                                    new Point(15, 16)
                                )
                            )
                        )
                    ),
                    new Polygon(
                        array(
                            new LinearRing(
                                array(
                                    new Point(17, 18),
                                    new Point(19, 20),
                                    new Point(21, 22),
                                    new Point(23, 24)
                                )
                            ),
                            new LinearRing(
                                array(
                                    new Point(25, 26),
                                    new Point(27, 28),
                                    new Point(29, 30),
                                    new Point(31, 32)
                                )
                            )
                        )
                    )
                )
            ),
            "%s correctly processes MultiPolygon"
        );

        $data[] = array(
            '0107000000020000000101000000000000000000f03f000000000000004001020000000300000000000000000008400000000000001040000000000000144000000000000018400000000000001c400000000000002040',
            new GeometryCollection(
                array(
                    new Point(1, 2),
                    new LineString(
                        array(
                            new Point(3, 4),
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    ),
                )
            ),
            "%s correctly processes GeometryCollection"
        );

        return $data;
    }

    public function ewkbDataProvider()
    {
        $data = array();

        $data[] = array(
            '0101000020E6100000000000000000F03F000000000000F03F',
            new Point(1, 1),
            "%s correctly processes Point"
        );

        $data[] = array(
            '0104000020E6100000020000000101000000000000000000F03F0000000000000040010100000000000000000008400000000000001040',
            new MultiPoint(
                array(
                    new Point(1, 2),
                    new Point(3, 4)
                )
            ),
            "%s correctly processes MultiPoint"
        );

        $data[] = array(
            '0102000020E610000002000000000000000000F03F000000000000004000000000000008400000000000001040',
            new LineString(
                array(
                    new Point(1, 2),
                    new Point(3, 4)
                )
            ),
            "%s correctly processes LineString"
        );

        $data[] = array(
            '0105000020E610000002000000010200000002000000000000000000F03F000000000000004000000000000008400000000000001040010200000002000000000000000000144000000000000018400000000000001C400000000000002040',
            new MultiLineString(
                array(
                    new LineString(
                        array(
                            new Point(1, 2),
                            new Point(3, 4)
                        )
                    ),
                    new LineString(
                        array(
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    )
                )
            ),
            "%s correctly processes MultiLineString"
        );

        $data[] = array(
            '0103000020E61000000200000005000000000000000000F03F000000000000004000000000000008400000000000001040000000000000144000000000000018400000000000001C400000000000002040000000000000F03F00000000000000400500000000000000000022400000000000002440000000000000264000000000000028400000000000002A400000000000002C400000000000002E40000000000000304000000000000022400000000000002440',
            new Polygon(
                array(
                    new LinearRing(
                        array(
                            new Point(1, 2),
                            new Point(3, 4),
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    ),
                    new LinearRing(
                        array(
                            new Point(9, 10),
                            new Point(11, 12),
                            new Point(13, 14),
                            new Point(15, 16)
                        )
                    )
                )
            ),
            "%s correctly processes Polygon"
        );

        $data[] = array(
            '0106000020E61000000200000001030000000200000005000000000000000000F03F000000000000004000000000000008400000000000001040000000000000144000000000000018400000000000001C400000000000002040000000000000F03F00000000000000400500000000000000000022400000000000002440000000000000264000000000000028400000000000002A400000000000002C400000000000002E400000000000003040000000000000224000000000000024400103000000020000000500000000000000000031400000000000003240000000000000334000000000000034400000000000003540000000000000364000000000000037400000000000003840000000000000314000000000000032400500000000000000000039400000000000003A400000000000003B400000000000003C400000000000003D400000000000003E400000000000003F40000000000000404000000000000039400000000000003A40',
            new MultiPolygon(
                array(
                    new Polygon(
                        array(
                            new LinearRing(
                                array(
                                    new Point(1, 2),
                                    new Point(3, 4),
                                    new Point(5, 6),
                                    new Point(7, 8)
                                )
                            ),
                            new LinearRing(
                                array(
                                    new Point(9, 10),
                                    new Point(11, 12),
                                    new Point(13, 14),
                                    new Point(15, 16)
                                )
                            )
                        )
                    ),
                    new Polygon(
                        array(
                            new LinearRing(
                                array(
                                    new Point(17, 18),
                                    new Point(19, 20),
                                    new Point(21, 22),
                                    new Point(23, 24)
                                )
                            ),
                            new LinearRing(
                                array(
                                    new Point(25, 26),
                                    new Point(27, 28),
                                    new Point(29, 30),
                                    new Point(31, 32)
                                )
                            )
                        )
                    )
                )
            ),
            "%s correctly processes MultiPolygon"
        );

        $data[] = array(
            '0107000020E6100000020000000101000000000000000000F03F000000000000004001020000000300000000000000000008400000000000001040000000000000144000000000000018400000000000001C400000000000002040',
            new GeometryCollection(
                array(
                    new Point(1, 2),
                    new LineString(
                        array(
                            new Point(3, 4),
                            new Point(5, 6),
                            new Point(7, 8)
                        )
                    ),
                )
            ),
            "%s correctly processes GeometryCollection"
        );

        return $data;
    }
}
