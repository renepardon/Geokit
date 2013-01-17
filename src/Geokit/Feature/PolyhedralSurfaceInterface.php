<?php

namespace Geokit\Feature;

/**
 * A PolyhedralSurface is a contiguous collection of polygons, which share
 * common boundary segments. For each pair of polygons that “touch”, the common
 * boundary shall be expressible as a finite collection of LineStrings. Each
 * such LineString shall be part of the boundary of at most 2 Polygon patches.
 *
 * For any two polygons that share a common boundary, the “top” of the polygon
 * shall be consistent. This means that when two LinearRings from these two
 * Polygons traverse the common boundary segment, they do so in opposite
 * directions. Since the Polyhedral surface is contiguous, all polygons will be
 * thus consistently oriented. This means that a non-oriented surface (such as
 * Möbius band) shall not have single surface representations. They may be
 * represented by a MultiSurface.
 *
 * If each such LineString is the boundary of exactly 2 Polygon patches, then
 * the PolyhedralSurface is a simple, closed polyhedron and is topologically
 * isomorphic to the surface of a sphere. By the Jordan Surface Theorem
 * (Jordan’s Theorem for 2-spheres), such polyhedrons enclose a solid
 * topologically isomorphic to the interior of a sphere; the ball. In this case,
 * the “top” of the surface will either point inward or outward of the enclosed
 * finite solid. If outward, the surface is the exterior boundary of the
 * enclosed surface. If inward, the surface is the interior of the infinite
 * complement of the enclosed solid. A Ball with some number of voids (holes)
 * inside can thus be presented as one exterior boundary shell, and some number
 * in interior boundary shells.
 */
interface PolyhedralSurfaceInterface extends SurfaceInterface
{
    /**
     * Returns the number of including polygons.
     *
     * @return integer
     */
    public function numPatches();

    /**
     * Returns a polygon in this surface, the order is arbitrary.
     *
     * @param  integer          $n
     * @return PolygonInterface
     */
    public function patchN($n);

    /**
     * Returns the collection of polygons in this surface that bounds the given
     * polygon “p” for any polygon “p” in the surface.
     *
     * @return MultiPolygonInterface
     */
    public function boundingPolygons(PolygonInterface $polygon);

    /**
     * Returns 1 (True) if the polygon closes on itself, and thus has no
     * boundary and encloses a solid.
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isClosed();
}
