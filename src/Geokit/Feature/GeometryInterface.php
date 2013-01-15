<?php

namespace Geokit\Feature;

/**
 * Geometry is the root class of the hierarchy. Geometry is an abstract
 * (non-instantiable) class.
 *
 * The instantiable subclasses of Geometry defined in this Standard are
 * restricted to 0, 1 and 2-dimensional geometric objects that exist in 2, 3 or
 * 4-dimensional coordinate space (R2, R3 or R4). Geometry values in R2 have
 * points with coordinate values for x and y. Geometry values in R3 have points
 * with coordinate values for x, y and z or for x, y and m. Geometry values in
 * R4 have points with coordinate values for x, y, z and m. The interpretation
 * of the coordinates is subject to the coordinate reference systems associated
 * to the point. All coordinates within a geometry object should be in the same
 * coordinate reference systems. Each coordinate shall be unambiguously
 * associated to a coordinate reference system either directly or through its
 * containing geometry.
 *
 * The z coordinate of a point is typically, but not necessarily, represents
 * altitude or elevation. The m coordinate represents a measurement.
 *
 * All Geometry classes described in this standard are defined so that instances
 * of Geometry are topologically closed, i.e. all represented geometries include
 * their boundary as point sets. This does not affect their representation, and
 * open version of the same classes may be used in other circumstances, such as
 * topological representations.
 */
interface GeometryInterface
{
    // --- Basic methods on geometric objects ----------------------------------

    /**
     * The inherent dimension of this geometric object, which must be less than
     * or equal to the coordinate dimension. In non-homogeneous collections,
     * this will return the largest topological dimension of the contained
     * objects.
     *
     * Returns an integer. This value is -1 for an empty geometry, 0 for
     * point geometries, 1 for curves, and 2 for surfaces.
     *
     * @return integer
     */
    public function dimension();

    /**
     * Returns the name of the instantiable subtype of Geometry of which this
     * geometric object is an instantiable member. The name of the subtype of
     * Geometry is returned as a string.
     *
     * @return string
     */
    public function geometryType();

    /**
     * Returns the Spatial Reference System ID for this geometric object.
     * This will normally be a foreign key to an index of reference systems
     * stored in either the same or some other datastore.
     *
     * @return integer
     */
    public function srid();

    /**
     * The minimum bounding box for this Geometry, returned as a Geometry.
     * The polygon is defined by the corner points of the bounding box
     * [(MINX, MINY), (MAXX, MINY), (MAXX, MAXY), (MINX, MAXY), (MINX, MINY)].
     * Minimums for Z and M may be added. The simplest representation of an
     * Envelope is as two direct positions, one containing all the minimums,
     * and another all the maximums. In some cases, this coordinate will be
     * outside the range of validity for the Spatial Reference System.
     *
     * @return GeometryInterface
     */
    public function envelope();

    /**
     * Exports this geometric object to a specific Well-known Text
     * Representation of Geometry.
     *
     * @return string
     */
    public function asText();

    /**
     * Exports this geometric object to a specific Well-known Binary
     * Representation of Geometry.
     *
     * @return string
     */
    public function asBinary();

    /**
     * Returns 1 (TRUE) if this geometric object is the empty Geometry. If true,
     * then this geometric object represents the empty point set ∅ for the
     * coordinate space. The return type is integer, but is interpreted as
     * Boolean, TRUE=1, FALSE=0.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * Returns 1 (TRUE) if this geometric object has no anomalous geometric
     * points, such as self intersection or self tangency. The description of
     * each instantiable geometric class will include the specific conditions
     * that cause an instance of that class to be classified as not simple.The
     * return type is integer, but is interpreted as Boolean, TRUE=1, FALSE=0.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isSimple();

    /**
     * Returns 1 (TRUE) if this geometric object has z coordinate values.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function is3D();

    /**
     * Returns 1 (TRUE) if this geometric object has m coordinate values.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isMeasured();

    /**
     * Returns the closure of the combinatorial boundary of this geometric
     * object. Because the result of this function is a closure, and hence
     * topologically closed, the resulting boundary can be represented using
     * representational Geometry primitives.
     *
     * @return GeometryInterface
     */
    public function boundary();

    // --- Methods for testing spatial relations between geometric objects -----

    /**
     * Returns 1 (TRUE) if this geometric object is “spatially equal” to
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function equals(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object is “spatially disjoint” from
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function disjoint(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object “spatially intersects”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function intersects(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object “spatially touches”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function touches(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object “spatially crosses”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function crosses(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object is “spatially within”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function within(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object “spatially contains”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function contains(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object “spatially overlaps”
     * anotherGeometry.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function overlaps(GeometryInterface $anotherGeometry);

    /**
     * Returns 1 (TRUE) if this geometric object is spatially related to
     * anotherGeometry by testing for intersections between the interior,
     * boundary and exterior of the two geometric objects as specified by the
     * values in the intersectionPatternMatrix. This returns FALSE if all the
     * tested intersections are empty except exterior (this) intersect exterior
     * (another).
     *
     * The $intersectionPatternMatrix is provided as a nine-character
     * string in row-major order, representing the dimensionalities of
     * the different intersections in the DE-9IM. Supported characters
     * include T, F, *, 0, 1, and 2.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function relate(GeometryInterface $anotherGeometry, $intersectionPatternMatrix);

    // --- Methods that support spatial analysis -------------------------------

    /**
     * Returns the shortest distance between any two Points in the two geometric
     * objects as calculated in the spatial reference system of this geometric
     * object. Because the geometries are closed, it is possible to find a point
     * on each geometric object involved, such that the distance between these
     * 2 points is the returned distance between their geometric objects.
     *
     * @return float
     */
    public function distance(GeometryInterface $anotherGeometry);

    /**
     * Returns a geometric object that represents all Points whose distance from
     * this geometric object is less than or equal to distance. Calculations are
     * in the spatial reference system of this geometric object. Because of the
     * limitations of linear interpolation, there will often be some relatively
     * small error in this distance, but it should be near the resolution of the
     * coordinates used.
     *
     * @param  float             $distance
     * @return GeometryInterface
     */
    public function buffer($distance);

    /**
     * Returns a geometric object that represents the convex hull of this
     * geometric object. Convex hulls, being dependent on straight lines, can be
     * accurately represented in linear interpolations for any geometry
     * restricted to linear interpolations.
     *
     * @return GeometryInterface
     */
    public function convexHull();

    /**
     * Returns a geometric object that represents the Point set intersection of
     * this geometric object with anotherGeometry.
     *
     * @return GeometryInterface
     */
    public function intersection(GeometryInterface $anotherGeometry);

    /**
     * Returns a geometric object that represents the Point set union of this
     * geometric object with anotherGeometry.
     *
     * @return GeometryInterface
     */
    public function union(GeometryInterface $anotherGeometry);

    /**
     * Returns a geometric object that represents the Point set difference of
     * this geometric object with anotherGeometry.
     *
     * @return GeometryInterface
     */
    public function difference(GeometryInterface $anotherGeometry);

    /**
     * Returns a geometric object that represents the Point set symmetric
     * difference of this geometric object with anotherGeometry.
     *
     * @return GeometryInterface
     */
    public function symDifference(GeometryInterface $anotherGeometry);
}
