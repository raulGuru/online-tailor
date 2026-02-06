# 13 - Glossary

- **Master Category**: top-level gender taxonomy (`men`, `women`) in `master_categories`.
- **Product Category/Subcategory**: second/third-level classification for products.
- **Stitching**: stitch type definition with a slug and cost baseline.
- **Stitching Cost**: tailor-specific cost override per stitch name/slug.
- **Pincode**: customer area code used to filter nearby tailors.
- **Measurement**: serialized body measurement payload stored in session and order details.
- **Order**: purchase header row linked to payment and measurement details.
- **Instamojo Order ID**: generated external-facing order reference stored in `orders` and `payments`.
- **Webhook call**: provider callback processed via Spatie webhook client and background job.
