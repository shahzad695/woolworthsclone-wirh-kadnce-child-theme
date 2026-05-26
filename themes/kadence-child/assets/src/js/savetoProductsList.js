import axios from "axios";

document.addEventListener("click", function (e) {
  const btn = e.target.closest(".product-save-button");
  if (!btn) return;

  e.preventDefault();

  const productId = btn.dataset.productId;
  const data = new URLSearchParams({
    action: "toggle_save_product",
    product_id: productId,
    nonce: woolworthSave.nonce,
  });

  axios
    .post(woolworthSave.ajaxUrl, data)
    .then((response) => {
      const res = response.data;
      console.log(res);
      if (!res.success) return;

      btn.classList.toggle("is-saved", res.data.state === "added");
      btn.textContent =
        res.data.state === "added" ? "Saved to list" : "Save to list";
    })
    .catch((error) => {
      console.error(error);
    });
});
