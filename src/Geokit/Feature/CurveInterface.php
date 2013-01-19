<?php

namespace Geokit\Feature;

/**
 * A Curve is a 1-dimensional geometric object usually stored as a sequence of
 * Points, with the subtype of Curve specifying the form of the interpolation
 * between Points. This standard defines only one subclass of Curve, LineString,
 * which uses linear interpolation between Points.
 *
 * A Curve is a 1-dimensional geometric object that is the homeomorphic image of
 * a real, closed, interval: D = [a,b] = {t∈R⏐ a≤t≤b} under a mapping
 * f:[a,b]→ Rn where n is the coordinate dimension of the underlying Spatial
 * Reference System.
 *
 * A Curve is simple if it does not pass through the same Point twice with the
 * possible exception of the two end points.
 *
 * A Curve is closed if its start Point is equal to its end Point.
 *
 * The boundary of a closed Curve is empty.
 *
 * A Curve that is simple and closed is a Ring.
 *
 * The boundary of a non-closed Curve consists of its two end Points.
 *
 * A Curve is defined as topologically closed, that is, it contains its
 * endpoints.
 */
interface CurveInterface extends GeometryInterface
{
    /**
     * The length of this Curve in its associated spatial reference.
     *
     * @return float
     */
    public function getLength();

    /**
     * The start Point of this Curve.
     *
     * @return PointInterface
     */
    public function getStartPoint();

    /**
     * The end Point of this Curve.
     *
     * @return PointInterface
     */
    public function getEndPoint();

    /**
     * Returns 1 (TRUE) if this Curve is closed [StartPoint ( ) = EndPoint ( )].
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isClosed();

    /**
     * Returns 1 (TRUE) if this Curve is closed [StartPoint ( ) = EndPoint ( )]
     * and this Curve is simple (does not pass through the same Point more than
     * once).
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isRing();
}
