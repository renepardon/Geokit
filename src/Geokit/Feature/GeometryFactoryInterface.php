<?php

namespace Geokit\Feature;

interface FeatureFactoryInterface
{
    /**
     * @param  float          $x
     * @param  float          $y
     * @param  float          $z
     * @param  float          $m
     * @return PointInterface
     */
    public function createPoint($x, $y, $z = null, $m = null);

    /**
     * @param  PointInterface[]    $points
     * @return LineStringInterface
     */
    public function createLineString(array $points);

    /**
     * @param  PointInterface $startPoint
     * @param  PointInterface $endPoint
     * @return LineInterface
     */
    public function createLine(PointInterface $startPoint, PointInterface $endPoint);

    /**
     * If the first and last points are not equal, the ring is
     * automatically closed by appending the first point to the end of the
     * string.
     *
     * @param  PointInterface[]    $points
     * @return LinearRingInterface
     */
    public function createLinearRing(array $points);

    /**
     * @param  LinearRingInterface   $exteriorRing
     * @param  LinearRingInterface[] $interiorRings
     * @return PolygonInterface
     */
    public function createPolygon(LinearRingInterface $exteriorRing, array $interiorRings = array());

    /**
     * @param  LinearRingInterface $exteriorRing
     * @return TriangleInterface
     */
    public function createTriangle(LinearRingInterface $exteriorRing);

    /**
     * @param  GeometryInterface[]         $geometries
     * @return GeometryCollectionInterface
     */
    public function createGeometryCollection(array $geometries = array());

    /**
     * Returns null if any of the point elements is not a Point.
     *
     * @param  PointInterface[]    $points
     * @return MultiPointInterface
     */
    public function createMultiPoint(array $points = array());

    /**
     * Returns null if any of the line string elements is not a LineString.
     *
     * @param  LineStringInterface[]    $lineStrings
     * @return MultiLineStringInterface
     */
    public function createMultiLineString(array $lineStrings = array());

    /**
     * Returns null if any of the polygon elements is not a Polygon.
     *
     * @param  PolygonInterface[]    $polygons
     * @return MultiPolygonInterface
     */
    public function createMultiPolygon(array $polygons = array());

    /**
     * @param  PolygonInterface[]         $polygons
     * @return PolyhedralSurfaceInterface
     */
    public function createPolyhedralSurface(array $polygons = array());

    /**
     * @param  TriangleInterface[] $triangles
     * @return TINInterface
     */
    public function createTIN(array $triangles = array());
}
