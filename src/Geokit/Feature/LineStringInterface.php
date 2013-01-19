<?php

namespace Geokit\Feature;

/**
 * A LineString is a Curve with linear interpolation between Points. Each
 * consecutive pair of Points defines a Line segment.
 */
interface LineStringInterface extends CurveInterface
{
    /**
     * The number of Points in this LineString.
     *
     * @return integer
     */
    public function getNumPoints();

    /**
     * Returns the specified Point N in this LineString.
     *
     * @param  integer        $n
     * @return PointInterface
     */
    public function getPointN($n);

    /**
     * Returns the points as a (possibly empty) array of objects that
     * support the PointInterface interface.
     *
     * Note: This method is not part of the SFS.
     *
     * @return PointInterface[]
     */
    public function getPoints();
}
