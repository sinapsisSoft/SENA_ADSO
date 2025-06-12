/**
 * Author:Diego Casallas
 * Description:
 * Date:05/06/2025
 * File:
 */
class AppStorage {

  constructor() {
    this.storage = localStorage;
    // Uncomment the line below to use sessionStorage instead
    // this.storage = sessionStorage;
  }

  setItem(key, value) {
    key = key.toLowerCase();
    if (value === null) {
      this.storage.removeItem(key);
      return;
    }
    if (this.storage.setItem(key, value)) return true;
    return false
  }

  getItem(key) {
    return this.storage.getItem(key);
  }
  removeItem(key) {
    this.storage.removeItem(key);
  }
  clear() {
    this.storage.clear();
  }
  key(index) {
    return this.storage.key(index);
  }
}
