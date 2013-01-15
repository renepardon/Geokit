<?php

namespace Geokit\Feature;

/**
 * A MultiCurve is a 1-dimensional GeometryCollection whose elements are Curves.
 *
 * MultiCurve is a non-instantiable class in this standard; it defines a set of
 * methods for its subclasses and is included for reasons of extensibility.
 *
 * A MultiCurve is simple if and only if all of its elements are simple and the
 * only intersections between any two elements occur at Points that are on the
 * boundaries of both elements.
 *
 * The boundary of a MultiCurve is obtained by applying the “mod 2” union rule:
 * A Point is in the boundary of a MultiCurve if it is in the boundaries of an
 * odd number of elements of the MultiCurve.
 *
 * A MultiCurve is closed if all of its elements are closed. The boundary of a
 * closed MultiCurve is always empty. A MultiCurve is defined as topologically
 * closed.
 */
interface MultiCurveInterface extends GeometryCollectionInterface
{
    /**
     * Returns 1 (TRUE) if this MultiCurve is closed
     * [StartPoint ( ) = EndPoint ( ) for each Curve in this MultiCurve].
     *
     * Note that this returns a boolean which is different from the
     * SFS specification, which stipulates an integer return value.
     *
     * @return boolean
     */
    public function isClosed();

    /**
     * The Length of this MultiCurve which is equal to the sum of the lengths
     * of the element Curves.
     *
     * @return float
     */
    public function length();
}