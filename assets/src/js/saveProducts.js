document.addEventListener("click", function (e) {
  const btn = e.target.closest(".product-save-button");
  if (!btn) return;

  e.preventDefault();

  const productId = btn.dataset.productId;

  axios
    .post(
      mySave.ajaxUrl,
      new URLSearchParams({
        action: "toggle_save_product",
        product_id: productId,
      })
    )
    .then((response) => {
      const res = response.data;
      if (!res.success) return;

      btn.classList.toggle("is-saved", res.data.state === "added");
      btn.textContent = res.data.state === "added" ? "Saved" : "Save";
    })
    .catch((error) => {
      console.error(error);
    });
});
