import pickle
from google.cloud import storage
import tensorflow as tf
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.layers import LSTM
from google.cloud import bigquery	
import firebase_admin
from firebase_admin import credentials

#download variables and tokenizer
blob_weight1 = bucket.blob('variables.index')
blob_weight2 = bucket.blob('variables.data-00000-of-00001')
blob_tfidf = bucket.blob('tokenizer.pickle')
blob_weight1.download_to_filename('/tmp/variables.index')
blob_weight2.download_to_filename('/tmp/variables.data-00000-of-00001')
# parameter setting
vocab_size = 1000
embedding_dim = 6 
max_length = 50 
trunc_type='post'
padding_type='post'
oov_tok = "<OOV>"
training_portion = .8

text = []
test_string = [text]
test = tokenizer.texts_to_sequences(test_string)
test_padded = pad_sequences(test, padding=padding_type, maxlen=max_length)

res = model.predict(test_padded)
result = np.argmax(res, axis=1)
print(result[0])