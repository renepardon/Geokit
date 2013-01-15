<?php

namespace Geokit\Feature;

/**
 * A MultiPoint is a 0-dimensional GeometryCollection. The elements of a
 * MultiPoint are restricted to Points. The Points are not connected or ordered
 * in any semantically important way (see the discussion at GeometryCollection).
 * A MultiPoint is simple if no two Points in the MultiPoint are equal (have
 * identical coordinate values in X and Y). Every MultiPoint is spatially equal
 * to a simple Multipoint.
 *
 * The boundary of a MultiPoint is the empty set.
 */
interface MultiPointInterface extends GeometryCollectionInterface
{
}
