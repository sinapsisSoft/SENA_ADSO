/* The code snippet is declaring variables and constants in JavaScript. Here's a breakdown of each
declaration: */
var objClass;
const contId = "containerGame";
const progress = "progressbarId";
const chronometer = "chronometerId";
const containerActions="container-actions";
const speed = 100;
const maxMilliseconds = 2000;

/**
 * The function setLevel creates a new Game object with specified parameters.
 * @param value - The `value` parameter in the `setLevel` function is typically used to specify the
 * level or difficulty setting for the game. This value could determine various aspects of the game
 * such as the speed of gameplay, the complexity of challenges, or the number of obstacles present.
 */
function setLevel(value) {
    objClass = new Game(contId, value, progress, chronometer, speed, maxMilliseconds,containerActions);

}
