<?php

namespace Geokit\Feature;

/**
 * A Point is a 0-dimensional geometric object and represents a single location
 * in coordinate space. A Point has an x-coordinate value, a y-coordinate value.
 * If called for by the associated Spatial Reference System, it may also have
 * coordinate values for z and m.
 * The boundary of a Point is the empty set.
 */
interface PointInterface extends GeometryInterface
{
    /**
     * The x-coordinate value for this Point.
     *
     * @return integer
     */
    public function x();

    /**
     * The y-coordinate value for this Point.
     *
     * @return integer
     */
    public function y();

    /**
     * The z-coordinate value for this Point, if it has one. Returns NIL
     * otherwise.
     *
     * @return integer
     */
    public function z();

    /**
     * The m-coordinate value for this Point, if it has one. Returns NIL
     * otherwise.
     *
     * @return integer
     */
    public function m();
}
