# ML-models

A collection of beginner-to-intermediate machine learning projects covering regression, classification, and content-based recommendation systems. Each notebook is self-contained and was developed/run in Google Colab.

## Projects

### 1. Big Mart Sales Prediction — `Big_Mart_Sales.ipynb`
Predicts item sales for a retail chain using the Big Mart Sales dataset.
- **Steps:** data cleaning (mean imputation for `Item_Weight`, mode imputation for `Outlet_Size`), exploratory data analysis with Seaborn/Matplotlib, label encoding of categorical features, train/test split.
- **Model:** XGBoost Regressor (`XGBRegressor`).
- **Evaluation:** R² score on training and test sets.
- **Libraries:** pandas, numpy, seaborn, matplotlib, scikit-learn, xgboost.

### 2. Movie Recommendation System — `MoviesPrediction.ipynb`
A content-based movie recommender using the IMDB movies dataset.
- **Steps:** combines `names`, `overview`, `genre`, and `crew` into a single text feature, vectorizes it with `TfidfVectorizer`, computes pairwise cosine similarity between movies.
- **Approach:** given a movie title (with fuzzy matching via `difflib`), returns the most similar movies based on cosine similarity of TF-IDF vectors.
- **Libraries:** pandas, numpy, difflib, scikit-learn.

### 3. Heart Disease Prediction — `heart_disease_pridiction.ipynb`
A binary classification model to predict the presence of heart disease from patient data.
- **Steps:** data inspection (nulls, class balance, summary statistics), stratified train/test split.
- **Model:** Logistic Regression (from `sklearn.linear_model`).
- **Evaluation:** accuracy score on both training and test data.
- **Libraries:** pandas, numpy, matplotlib, scikit-learn.

### 4. Simple Linear Regression — `simple_linear_regression.ipynb`
A foundational regression example predicting salary based on years of experience.
- **Steps:** train/test split, model fitting, visualization of training and test results.
- **Model:** Linear Regression (`sklearn.linear_model.LinearRegression`).
- **Evaluation:** R² score; scatter plots comparing predicted vs. actual salary trends.
- **Libraries:** pandas, numpy, matplotlib, scikit-learn.

## Tech Stack
- **Language:** Python
- **Core Libraries:** pandas, NumPy, scikit-learn, XGBoost, Matplotlib, Seaborn
- **Environment:** Google Colab / Jupyter Notebook

## Getting Started

1. Clone the repository:
   ```bash
   git clone https://github.com/tony-143/ML-models.git
   cd ML-models
   ```
2. Install dependencies:
   ```bash
   pip install pandas numpy scikit-learn xgboost matplotlib seaborn
   ```
3. Open any notebook in Jupyter or upload it to Google Colab (each notebook includes an "Open in Colab" badge).
4. Make sure the corresponding dataset (e.g. `big_mart_data.csv`, `imdb_movies.csv`, `heart_disease_data.csv`, `Salary_Data.csv`) is available at the path referenced in the notebook (typically `/content/` for Colab).

## Author
**Tony (tony-143)** — AI/ML Engineer, exploring Machine Learning algorithms and full-stack development.
- GitHub: [github.com/tony-143](https://github.com/tony-143)
- LinkedIn: [in/sai-teja--](https://www.linkedin.com/in/sai-teja--)
