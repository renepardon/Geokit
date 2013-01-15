<?php

namespace Geokit\Feature;

/**
 * A GeometryCollection is a geometric object that is a collection of some
 * number of geometric objects.
 *
 * All the elements in a GeometryCollection shall be in the same Spatial
 * Reference System. This is also the Spatial Reference System for the
 * GeometryCollection.
 *
 * GeometryCollection places no other constraints on its elements. Subclasses of
 * GeometryCollection may restrict membership based on dimension and may also
 * place other constraints on the degree of spatial overlap between elements.
 */
interface GeometryCollectionInterface extends GeometryInterface
{
    /**
     * Returns the number of geometries in this GeometryCollection.
     *
     * @return integer
     */
    public function numGeometries();

    /**
     * Returns the Nth geometry in this GeometryCollection.
     *
     * @param  integer           $n
     * @return GeometryInterface
     */
    public function geometryN($n);

    /**
     * Returns the geometries as a (possibly empty) array of objects that
     * support the GeometryInterface interface.
     *
     * Note: This method is not part of the SFS.
     *
     * @return GeometryInterface[]
     */
    public function geometries();
}
