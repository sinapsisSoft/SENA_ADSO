class Toast {
  constructor(id) {
    
    this.textColor = ["text-success", "text-primary", "text-warning", "text-danger"];
    this.backgroundColor = ["bg-success", "bg-primary", "bg-warning", "bg-danger"];

    this.icons = ["bi-hand-thumbs-up-fill", "bi-info-square-fill", "bi-exclamation-triangle-fill", "bi-x-octagon-fill"];
    this.toast = null;
    this.toastBootstrap = null;
    this.toast = document.getElementById(id);
    this.toastBootstrap = bootstrap.Toast.getOrCreateInstance(this.toast);
  }
  show(title, subTitle, message, type ) {
    this.title = title || "Bootstrap Toast";
    this.subTitle = subTitle || "This is a toast";
    this.message = message || "Hello, world! This is a toast message.";
    this.type = type || 0; // Default to type 0
    
    this.toast.innerHTML = '';
    let toastContent = `<div class="toast-header">
        <i class="bi ${this.icons[this.type]} p-1 ${this.textColor[this.type]}"></i>
        <strong class="me-auto ${this.textColor[this.type]}">${this.title}</strong>
        <small>${this.subTitle}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body ${this.backgroundColor[this.type]} text-white">
      ${this.message}
      </div>`;
    this.toast.innerHTML = toastContent;
    this.toastBootstrap.show();
  }
}