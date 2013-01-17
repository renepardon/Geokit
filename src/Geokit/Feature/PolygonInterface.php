<?php

namespace Geokit\Feature;

/**
 * A Polygon is a planar Surface defined by 1 exterior boundary and 0 or more
 * interior boundaries. Each interior boundary defines a hole in the Polygon.
 *
 * The exterior boundary LinearRing defines the “top” of the surface which is
 * the side of the surface from which the exterior boundary appears to traverse
 * the boundary in a counter clockwise direction. The interior LinearRings will
 * have the opposite orientation, and appear as clockwise when viewed from the
 * “top”.
 *
 * The assertions for Polygons (the rules that define valid Polygons) are as
 * follows:
 *
 * a) Polygons are topologically closed;
 *
 * b) The boundary of a Polygon consists of a set of LinearRings that make up
 * its exterior and interior boundaries;
 *
 * c) No two Rings in the boundary cross and the Rings in the boundary of a
 * Polygon may intersect at a Point but only as a tangent;
 *
 * d) A Polygon may not have cut lines, spikes or punctures;
 *
 * e) The interior of every Polygon is a connected point set;
 *
 * f) The exterior of a Polygon with 1 or more holes is not connected. Each hole
 * defines a connected component of the exterior.
 *
 * In the above assertions, interior, closure and exterior have the standard
 * topological definitions. The combination of (a) and (c) makes a Polygon a
 * regular closed Point set. Polygons are simple geometric objects.
 */
interface PolygonInterface extends SurfaceInterface
{
    /**
     * Returns the exterior ring of this Polygon.
     *
     * @return LineStringInterface
     */
    public function exteriorRing();

    /**
     * Returns the number of interior rings in this Polygon.
     *
     * @return integer
     */
    public function numInteriorRings();

    /**
     * Returns the Nth interior ring for this Polygon as a LineString.
     *
     * @param  integer             $n
     * @return LineStringInterface
     */
    public function interiorRingN($n);

    /**
     * Returns the interior rings as a (possibly empty) array of objects
     * that support the LineString interface.
     *
     * Note: This method is not part of the SFS.
     *
     * @return LineStringInterface[]
     */
    public function interiorRings();
}
