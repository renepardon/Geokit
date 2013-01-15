<?php

namespace Geokit\Feature;

/**
 * A MultiSurface is a 2-dimensional GeometryCollection whose elements are
 * Surfaces, all using coordinates from the same coordinate reference system.
 * The geometric interiors of any two Surfaces in a MultiSurface may not
 * intersect in the full coordinate system. The boundaries of any two coplanar
 * elements in a MultiSurface may intersect, at most, at a finite number of
 * Points. If they were to meet along a curve, they could be merged into a
 * single surface.
 *
 * MultiSurface is an instantiable class in this Standard, and may be used to
 * represent heterogeneous surfaces collections of polygons and polyhedral
 * surfaces. It defines a set of methods for its subclasses. The subclass of
 * MultiSurface is MultiPolygon corresponding to a collection of Polygons only.
 * Other collections shall use MultiSurface.
 *
 * NOTE: The geometric relationships and sets are the common geometric ones in
 * the full coordinate systems. The use of the 2D map operations may classify
 * the elements of a valid 3D MultiSurface as having overlapping interiors in
 * their 2D projections.
 */
interface MultiSurfaceInterface extends GeometryCollectionInterface
{
    /**
     * The area of this MultiSurface, as measured in the spatial reference
     * system of this MultiSurface.
     *
     * @return float
     */
    public function area();

    /**
     * The mathematical centroid for this MultiSurface. The result is not
     * guaranteed to be on this MultiSurface.
     *
     * @return PointInterface
     */
    public function centroid();

    /**
     * A Point guaranteed to be on this MultiSurface.
     *
     * @return PointInterface
     */
    public function pointOnSurface();
}
