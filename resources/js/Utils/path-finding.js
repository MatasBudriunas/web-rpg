export function findPath(start, target, map) {
    const directions = [
        { x: 1, y: 0 },
        { x: -1, y: 0 },
        { x: 0, y: 1 },
        { x: 0, y: -1 }
    ];

    const visited = new Set();
    const queue = [{ x: start.x, y: start.y, path: [] }];

    while (queue.length > 0) {
        const { x, y, path } = queue.shift();
        if (visited.has(`${x},${y}`)) continue;
        visited.add(`${x},${y}`);

        if (x === target.x && y === target.y) return [...path, { x, y }];

        for (const direction of directions) {
            const newX = x + direction.x;
            const newY = y + direction.y;
            const tile = map.tiles.find(tile => tile.coordinates_x === newX && tile.coordinates_y === newY);
            if (tile && tile.is_passable) {
                queue.push({ x: newX, y: newY, path: [...path, { x, y }] });
            }
        }
    }

    return null;
}
